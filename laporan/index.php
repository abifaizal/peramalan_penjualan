<?php
/**
 * HTML2PDF Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    require_once(dirname(__FILE__).'/../html2pdf/html2pdf.class.php');

    // get the HTML
	if(@$_GET['page']=='coba') {
	    ob_start();
	    include(dirname(__FILE__).'/isi/coba.php');
	    $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "coba.pdf";
	} else if(@$_GET['page']=='nota_pembelian') {
        ob_start();
        include(dirname(__FILE__).'/isi/nota_pembelian2.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'B5', 'en');
        $nama_file = "nota_pembelian".$no_faktur.".pdf";
    } else if(@$_GET['page']=='nota_penjualan') {
        ob_start();
        include(dirname(__FILE__).'/isi/nota_penjualan.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A8', 'en');
        $nama_file = "nota_penjualan".$no_pjl.".pdf";
    } else if(@$_GET['page']=='laporan_penjualan_rangkuman') {
        ob_start();
        include(dirname(__FILE__).'/isi/laporan_penjualan_rangkuman.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_penjualan_rangkuman.pdf";
    } else if(@$_GET['page']=='laporan_penjualan_detail') {
        ob_start();
        include(dirname(__FILE__).'/isi/laporan_penjualan_detail.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_penjualan_detail.pdf";
    } else if(@$_GET['page']=='laporan_pembelian_detail') {
        ob_start();
        include(dirname(__FILE__).'/isi/laporan_pembelian_detail.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_pembelian_detail.pdf";
    } else if(@$_GET['page']=='laporan_pembelian_rangkuman') {
        ob_start();
        include(dirname(__FILE__).'/isi/laporan_pembelian_rangkuman.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_pembelian_rangkuman.pdf";
    } else if(@$_GET['page']=='laporan_peramalan') {
        ob_start();
        include(dirname(__FILE__).'/isi/laporan_peramalan.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_peramalan.pdf";
    } else if(@$_GET['page']=='laporan_peramalan_multi') {
        ob_start();
        include(dirname(__FILE__).'/isi/laporan_peramalan_multi.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_peramalan.pdf";
    }

    // convert to PDF
    try
    {
        $html2pdf = $format;
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($nama_file);
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
