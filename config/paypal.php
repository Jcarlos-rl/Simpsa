<?php
    return array(
        // set your paypal credential
        'client_id' => 'Ac7UbWnpbgNs9EhdYRtiIpGx_rS0wafuqjbTduXkUtskSvBzJ_VO6MphKos5TLs9-Z4s6cJDE2S-xyfZ',
        'secret' => 'ENNkL1FuFBNr6gBzlQH55CHKk5pXdZwNe7zNxJMl1Sss4GDqYZgi1q9nb7LtAX11a1bBn1z_QBH8qRro',

        /**
         * SDK configuration
         */
        'settings' => array(
            /**
             * Available option 'sandbox' or 'live'
             */
            'mode' => 'sandbox',

            /**
             * Specify the max request time in seconds
             */
            'http.ConnectionTimeOut' => 30,

            /**
             * Whether want to log to a file
             */
            'log.LogEnabled' => true,

            /**
             * Specify the file that want to write on
             */
            'log.FileName' => storage_path() . '/logs/paypal.log',

            /**
             * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
             *
             * Logging is most verbose in the 'FINE' level and decreases as you
             * proceed towards ERROR
             */
            'log.LogLevel' => 'FINE'
        ),
    );
?>
