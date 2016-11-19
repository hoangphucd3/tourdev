<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OnePayController extends Controller
{
    private $checkoutURL;

    private $merchantId;

    private $accessCode;

    private $hashCode;

    private $returnURL;

    public function __construct()
    {
        $this->checkoutURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op';
        $this->merchantId = 'ONEPAY';
        $this->accessCode = 'D67342C2';
        $this->hashCode = 'A3EFDFABA8653DF2342E8DAC29B51AF0';
    }

    /**
     * @Route("/checkout/onepay", name="onepay_checkout_url")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function builCheckoutUrl(Request $request)
    {
        $price = $request->query->get('price');
        $orderInfo = $request->query->get('orderId');

        $this->setReturnUrl($this->generateUrl('onepay_checkout_result', array('orderId' => $orderInfo), UrlGeneratorInterface::ABSOLUTE_URL));

        $vpcURL = $this->checkoutURL . "?";

        $data = array(
            'Title' => 'VPC 3-Party',
            'virtualPaymentClientURL' => $this->checkoutURL,
            'vpc_Version' => 2,
            'vpc_Command' => 'pay',
            'vpc_AccessCode' => $this->accessCode,
            'vpc_MerchTxnRef' => date('YmdHis') . rand(),
            'vpc_Merchant' => $this->merchantId,
            'vpc_OrderInfo' => 'Thanh toán cho hóa đơn #' . $orderInfo,
            'vpc_Amount' => $price,
            'vpc_Locale' => 'vn',
            'vpc_ReturnURL' => $this->returnURL,
            'vpc_TicketNo' => $_SERVER["REMOTE_ADDR"],
            'vpc_Currency' => 'VND',
        );

        // Remove the Virtual Payment Client URL from the parameter hash.
        unset($data["virtualPaymentClientURL"]);
        unset($data["SubButL"]);

        $stringHashData = "";

        // arrange array data a-z before make a hash.
        ksort($data);

        // set a parameter to show the first pair in the URL.
        $appendAmp = 0;

        foreach ($data as $key => $value) {
            // create the md5 input and URL leaving out any fields that have no value
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value;
                if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }

        $stringHashData = rtrim($stringHashData, "&");

        if (strlen($this->hashCode) > 0) {
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $this->hashCode)));
        }

        return $this->redirect($vpcURL);
    }

    /**
     * @Route("checkout/onepay/result", name="onepay_checkout_result")
     *
     * @param Request $request
     * @return Response
     */
    public function getResult(Request $request)
    {
        $returnData = $request->query->all();

        $vpc_Txn_Secure_Hash = $returnData['vpc_SecureHash'];
        unset($returnData['vpc_SecureHash']);

        $errorExists = false;

        ksort($returnData);

        if (strlen($this->hashCode) > 0 && $returnData ["vpc_TxnResponseCode"] != "7" && $returnData ["vpc_TxnResponseCode"] != "No Value Returned") {

            $stringHashData = "";

            // sort all the incoming vpc response fields and leave out any with no value
            foreach ($returnData as $key => $value) {
                if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }

            $stringHashData = rtrim($stringHashData, "&");

            if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $this->hashCode)))) {
                // Secure Hash validation succeeded, add a data field to be displayed
                // later.
                $hashValidated = "CORRECT";
            } else {
                // Secure Hash validation failed, add a data field to be displayed
                // later.
                $hashValidated = "INVALID HASH";
            }
        } else {
            // Secure Hash was not validated, add a data field to be displayed later.
            $hashValidated = "INVALID HASH";
        }

        // Standard Receipt Data
        $amount = $this->null2unknown($returnData["vpc_Amount"]);
        $locale = $this->null2unknown($returnData["vpc_Locale"]);
        $command = $this->null2unknown($returnData["vpc_Command"]);
        $version = $this->null2unknown($returnData["vpc_Version"]);
        $orderInfo = $this->null2unknown($returnData["vpc_OrderInfo"]);
        $merchantID = $this->null2unknown($returnData["vpc_Merchant"]);
        $merchTxnRef = $this->null2unknown($returnData["vpc_MerchTxnRef"]);
        $transactionNo = $this->null2unknown($returnData["vpc_TransactionNo"]);
        $txnResponseCode = $this->null2unknown($returnData["vpc_TxnResponseCode"]);

        if ('0' == $txnResponseCode) {
            $orderId = $this->null2unknown($returnData["orderId"]);

            return $this->redirectToRoute('tour_order_checkout_onepay_complete', array('id' => $orderId));
        } else {
            $content = $this->getResponseDescription($txnResponseCode);

            return $this->render('Checkout/checkout_onepay_error.html.twig', ['content' => $content]);
        }
    }

    public function setOnePayInfo($checkoutURL, $merchantId, $accessCode, $hashCode, $returnURL)
    {
        $this->checkoutURL = $checkoutURL;
        $this->merchantId = $merchantId;
        $this->accessCode = $accessCode;
        $this->hashCode = $hashCode;
        $this->returnURL = $returnURL;
    }

    /**
     * @param $url
     */
    public function setReturnUrl($url)
    {
        $this->returnURL = $url;
    }

    /**
     * @param $responseCode
     * @return string
     */
    private function getResponseDescription($responseCode)
    {
        switch ($responseCode) {
            case "0" :
                $result = "Giao dịch thành công - Approved";
                break;
            case "1" :
                $result = "Ngân hàng từ chối giao dịch - Bank Declined";
                break;
            case "3" :
                $result = "Mã đơn vị không tồn tại - Merchant not exist";
                break;
            case "4" :
                $result = "Không đúng access code - Invalid access code";
                break;
            case "5" :
                $result = "Số tiền không hợp lệ - Invalid amount";
                break;
            case "6" :
                $result = "Mã tiền tệ không tồn tại - Invalid currency code";
                break;
            case "7" :
                $result = "Lỗi không xác định - Unspecified Failure ";
                break;
            case "8" :
                $result = "Số thẻ không đúng - Invalid card Number";
                break;
            case "9" :
                $result = "Tên chủ thẻ không đúng - Invalid card name";
                break;
            case "10" :
                $result = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
                break;
            case "11" :
                $result = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
                break;
            case "12" :
                $result = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
                break;
            case "13" :
                $result = "Vượt quá hạn mức thanh toán - Exist Amount";
                break;
            case "21" :
                $result = "Số tiền không đủ để thanh toán - Insufficient fund";
                break;
            case "99" :
                $result = "Người sủ dụng hủy giao dịch - User cancel";
                break;
            default :
                $result = "Giao dịch thất bại - Failured";
        }
        return $result;
    }

    /**
     * @param $data
     * @return string
     */
    private function null2unknown($data)
    {
        if ($data == "") {
            return "No Value Returned";
        } else {
            return $data;
        }
    }
}
