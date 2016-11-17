<?php

namespace AppBundle\Twig;


class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('priceFilter', array($this, 'priceFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('discount', array($this, 'priceDiscount')),
            new \Twig_SimpleFunction('priceHtml', array($this, 'priceHtml')),
            new \Twig_SimpleFunction('contentPriceHtml', array($this, 'contentPriceHtml')),
        );
    }

    public function priceFilter($price, $decimals = 0, $decPoint = ',', $thousandsSep = '.', $currency = 'đ')
    {
        $priceFormat = '%2$s&nbsp;%1$s';

        $negative = $price < 0;
        $price = floatval($negative ? $price * -1 : $price);
        $price = number_format($price, $decimals, $decPoint, $thousandsSep);

        $formatted_price = ($negative ? '-' : '') . sprintf($priceFormat, '<sup>' . ($currency) . '</sup>', $price);

        return $formatted_price;
    }

    public function priceHtml($from, $to)
    {
        if (!empty($from) && !empty($to)) {
            $price = '<strong>' . $this->priceFilter($to) . '<p><span class="cs-color">' . $this->priceFilter($from) . '</span></p></strong>';
        } elseif (!empty($to)) {
            $price = '<strong>' . $this->priceFilter($to) . '</strong>';
        } else {
            $price = '<strong>' . $this->priceFilter($from) . '</strong>';
        }

        $price .= '<p>mỗi người</p>';

        return $price;
    }

    public function contentPriceHtml($from, $to)
    {
        $price = '<span>Giá</span>';

        if (!empty($from) && !empty($to)) {
            $price .= '<strong>' . $this->priceFilter($to) . ' <em>' . $this->priceFilter($from) . '</em></strong>';
        } elseif (!empty($to)) {
            $price .= '<strong>' . $this->priceFilter($to) . '</strong>';
        } else {
            $price .= '<strong>' . $this->priceFilter($from) . '</strong>';
        }

        return $price;
    }

    public function priceDiscount($regularPirce, $salePrice)
    {
        $output = '';
        if (!empty($regularPirce) && !empty($salePrice)) {
            $percent = round((($regularPirce - $salePrice) / $regularPirce) * 100);

            $output = '<span class="cs-off-price">' . $percent . '%<em>Off</em></span>';
        }

        return $output;
    }

    public function getName()
    {
        return 'app_extension';
    }
}