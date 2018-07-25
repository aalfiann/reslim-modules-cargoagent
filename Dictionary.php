<?php
/**
 * This class is a part of Cargo Agent project
 * @author M ABD AZIZ ALFIAN <github.com/aalfiann>
 *
 * Don't remove this class unless You know what to do
 *
 */
namespace modules\cargoagent;
    /**
     * A class for transaction management cargo agent
     *
     * @package    Dictionary Cargo Agent
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim-modules-cargoagent/blob/master/LICENSE.md  MIT License
     */
	class Dictionary {
        /**
         * @param $id is indonesian dictionary
         *
         */
        public static $id = [
            //Transaction process
            'waybill_created' => 'Menunggu proses pengiriman',
            'waybill_manifested' => 'Sedang dalam proses pengiriman',
            'waybill_onboard' => 'Sedang dalam perjalanan menuju destinasi',
            'waybill_arrived' => 'Barang telah sampai di destinasi',
            'waybill_delivered' => 'Barang telah diterima oleh:',
            'waybill_picked' => 'Barang akan diambil sendiri oleh penerima',
            'waybill_pickup' => 'Proses penjemputan barang oleh origin',
            'waybill_mutation' => 'Pembayaran transaksi Waybill',
            //Transaction onhold
            'waybill_onhold_origin' => 'Barang sementara ditahan di origin',
            'waybill_onhold_destination' => 'Barang sementara ditahan di destinasi',
            //Transaction failed
            'waybill_void' => 'Transaksi pengiriman telah dibatalkan',
            'waybill_failed' => 'Pengantaran barang gagal karena',
            'waybill_return' => 'Sedang dalam proses retur ke origin',
            'waybill_return_consignor' => 'Barang di retur sesuai permintaan pengirim',
            'waybill_return_consignee' => 'Barang di retur sesuai permintaan penerima',
            'waybill_not_found' => 'Waybill tidak ditemukan! Harap periksa kembali no Waybill Anda',
            'waybill_not_found_1' => 'Waybill tidak ditemukan, harap periksa atau trace kembali Waybill Anda!',
            //System
            'execute_failed' => 'Gagal eksekusi perintah ke dalam database!'
        ];

        /**
         * @param $en is english dictionary
         *
         */
        public static $en = [
            //Transaction process
            'waybill_created' => 'Waiting for shipping process',
            'waybill_manifested' => 'In the delivery process',
            'waybill_onboard' => 'On the way to the destination',
            'waybill_arrived' => 'Goods have arrived at the destination',
            'waybill_delivered' => 'Goods have been received by:',
            'waybill_picked' => 'Goods will be picked up by the recipient',
            'waybill_pickup' => 'Pickup process by origin',
            'waybill_mutation' => 'Payment transaction Waybill',
            //Transaction onhold
            'waybill_onhold_origin' => 'Goods temporarily held in origin',
            'waybill_onhold_destination' => 'Goods temporarily held in destination',
            //Transaction failed
            'waybill_void' => 'The shipping transaction has been void',
            'waybill_failed' => 'Delivery of goods failed because',
            'waybill_return' => 'In the process of returning to origin',
            'waybill_return_consignor' => 'Goods are returned at the sender\'s request',
            'waybill_return_consignee' => 'Goods are returned at the recipient\'s request',
            'waybill_not_found' => 'Waybill not found, Please check your Waybill number!',
            'waybill_not_found_1' => 'Waybill not found, Please check or trace back your Waybill!',
            //System
            'execute_failed' => 'Failed to execute commands into the database!'
        ];

        /**
         * @param $key : input the key of dictionary
         * @return string dictionary language
         */
        public static function write($key,$lang=''){
            switch($lang){
                case 'id':
                    return self::$id[$key];
                break;
                default:
                    return self::$en[$key];
            }
        }
    }