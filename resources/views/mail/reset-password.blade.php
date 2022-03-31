<!DOCTYPE html>

<html>

<head>
    <title> {{ __('mafqodat') }} </title>
    <meta charset="utf-8">
    <meta name="description" content="welcoma">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- *******************************
    **********************
    **************
 -->

</head>

<body style="padding: 0px; margin: 0px; direction: rtl; text-align: right;">
    <div style="width: 750px; margin: auto; background-color: #f5f5f5; padding:20px ;">
        <div style=" background: #fff ; padding: 8px 0px;">

            <div style="text-align: left; padding: 20px 0px 10px 100px ;">
                <img src="https://i.ibb.co/M9FDsKt/2021-01-31-1.png" alt="">
            </div>

            <div style="margin: 10px 10px;">
                <h2 style="color:#354052 ; text-align:right">{{ __('mafqodat') }}</h2>
            </div>

        </div>


        <div style="margin: 10px 10px; text-align:center">
            <h2 style="color:#354052 ; text-align:center">{{ __('to_reset_password') }}</h2>

            <a style="background: rgb(31, 120, 199) ;
                color: #fff;
                text-decoration: none;
                width: 220px;
                margin: 32px auto 20px;
                align-items: center;
                box-shadow: 0px 3px 6px #00000047;
                justify-content: center;
                display: flex;
                border-radius: 4px;
                background: #7367F0;
                height: 55px;"
                href="{{ $data['link'] }}"
            >
                {{ __('reset_password') }}
            </a>

        </div>

    </div>
</body>
<!-- end-body
=================== -->

</html>
