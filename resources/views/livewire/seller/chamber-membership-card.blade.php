{{-- <div>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .card-container {
            position: relative;
            width: 700px;
            height: 100vh;
            margin: 0 auto;
            /* background: url('{{ asset('assets/img/bg/ChemberMembershipCard.jpg') }}') no-repeat; */
            background: url('{{ asset('assets/img/bg/MemberShipCerti.jpg') }}') no-repeat;
            background-size: contain;
        }

        .card-text {
            position: absolute;
            color: #000;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        /* .name {
            top: 219px;
            left: 492px;
            font-size: 16px;
            font-weight: bold;
        } */

        .name {
            top: 322px;
            left: 70px;
            font-size: 20px;
            font-weight: bold;
            /* width: 100%; */
            text-align: center
        }

        .phone {
            top: 100px;
            left: 40px;
        }

        .email {
            top: 130px;
            left: 40px;
        }

        .address {
            top: 160px;
            left: 40px;
            width: 300px;
        }
    </style>

    <div class="container" style="height: 100vh; align-content: center;">
        <div class="card-container">
            <div class="card-text name">{{ $lead->name ?? '' }}</div>
        </div>
    </div>
</div> --}}

<div>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card-container {
            position: relative;
            width: 500px;
            height: 100vh;
            max-height: 800px;
            /* Adjust based on your image aspect ratio */
            background: url('{{ asset('assets/img/bg/MemberShipCerti.jpg') }}') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
        }

        .card-text {
            color: #000;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .name {
            position: absolute;
            top: 46.5%;
            /* margin-top: 322px; */
            font-size: 20px;
            font-weight: 600;
            font-family: Georgia, 'Times New Roman', Times, serif;
            /* text-align: center; */
            /* width: 100%; */
        }
    </style>

    {{-- <div class="card-container">
        <div class="card-text name">{{ $lead->name ?? '' }}</div>
        
    </div> --}}

     <div style="position: relative; width: 700px; height: 100vh;">
        <img src="{{ public_path('assets/img/bg/MemberShipCerti.jpg') }}"
            style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: 0;">
        <div
            style="position: absolute; top: 48.5%; left: 50%; transform: translate(-50%, -50%); font-size: 20px; font-weight: bold; font-family: Georgia, serif; z-index: 1;">
            {{ $lead->name ?? '' }}
        </div>
    </div>
</div>
