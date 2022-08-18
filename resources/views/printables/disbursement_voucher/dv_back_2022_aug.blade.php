<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Disbursement Voucher</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/print.css') }}?s={{\Illuminate\Support\Str::random()}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

    <style type="text/css">

        .arrow {
            position: absolute;
            overflow: hidden;
            display: inline-block;
            font-size: 3px;
            width: 3em;
            height: 3em;
            border-top: 2px solid black;
            border-right: 2px solid black ;
            transform: rotate(54deg) skew(20deg);
        }
        li{
            text-align: justify;
        }
    </style>

</head>


<body>
    <p class="no-margin text-center text-strong">DISBURSEMENT VOUCHER</p>
    <p class="no-margin text-center text-strong">(DV)</p>
    <p class="text-center"><i>INSTRUCTIONS</i></p>

    <div style="border: 1px solid black; padding: 20px 12px 10px 5px">
        <ol type="A" class="text-strong font-px12">
            <li>
                This DV is a form used to pay and obligation to employee/individuals/agencies/creditor for goods purchased or services rendered.  It shall be prepared by the Requesting Office/Unit.  The Accounting Division/Unit shall stamp on the face of this form the date of receipt from the requesting Unit.
            </li>
            <li>
                This form shall be accomplished as follows
            </li>
            <ol>
                <li>
                    Entity Name – name of the agency/entity
                </li>
                <li>
                    Fund Cluster – the fund cluster name/code in accordance with UACS in which the disbursement should be changed
                </li>
                <li>
                    Date – date of preparation of the DV
                </li>
                <li>
                    DV No. – number assigned to the DV by the Accounting Division/Unit.  It shall be numbered as follows:
                    <br>
                    <u style="font-size:10px;">0000</u> &nbsp;&nbsp;&nbsp; <u style="font-size:10px;">00</u> &nbsp;&nbsp;&nbsp; <u style="font-size:10px;">0000</u>
                    <div class="row">
                        <div style="border-left: 2px solid; width: 95px; border-bottom: 2px solid; height: 60px; margin-left:26px;">
                            <div class="arrow" style="margin-top: 55px; margin-left: 85px;"></div>
                        </div>
                        <div style="border-left: 2px solid; width: 60px; border-bottom: 2px solid; height: 47px; margin-left:61px; margin-top:-60px;">
                            <div class="arrow" style="margin-top: 41px; margin-left: 50px;"></div>
                        </div>
                        <div style="border-left: 2px solid; width: 22px; border-bottom: 2px solid; height: 25px; margin-left:98px; margin-top:-47px;">
                            <div class="arrow" style="margin-top: 20px; margin-left: 12px;"></div>
                        </div>
                        <div class="row">
                            <p style="margin-left:145px; margin-top:-11px; font-size:10px;">
                                Serial number<br>
                                (one series each year)<br>
                                <span>Month</span><br>
                                <span>Year</span>
                            </p><br>
                        </div>
                    </div>

                </li>
                <li>
                    Mode of Payment – put a check “  “ mark in the appropriate box of the mode of payment (MDS Check, Commercial Check, ADA, Others)
                </li>
                <li>
                    Payee – name of the payee/creditor
                </li>
                <li>
                    TIN/Employee No. – Tax Identification Number (TIN) of the claimant/Identification Number assigned by the agency to the officer/Employee
                </li>
                <li>
                    ORS/BURS No. – the serial number of the ORS or BURS supporting the DV
                </li>
                <li>
                    Address – address of the claimant
                </li>
                <li>
                    Particulars – brief description of the disbursement
                </li>
                <li>
                    Responsibility Center (Office/Unit/Project and Code) – the office/unit project and code assigned to the cost center where the  disbursement shall be charged
                </li>
                <li>
                    MFO/PAF – MFO or PAP as shown in the GAARD/SARO/GARO
                </li>
                <li>
                    Amount – Amount of claim
                </li>
                <li>
                    Certified (Box A) – certification by the responsible officer having direct supervision and knowledge of the facts of the transaction.
                </li>
                <li>
                    Accounting Entry (Box B) – the respective accounting entry for the disbursement.
                </li>
                <li>
                    Certified (Box C) – certification by the Head of Accounting Unit or his/her authorized representative on the availability of cash, subject to ADA, on the completeness of the supporting documents and the propriety of the amount claimed.
                    The certifying officer shall affix his/her signature and indicate his/her name and position/.designation, and the date of signing on the spaces provided.
                </li>
                <li>
                    Approved for Payment (Box D) – approval by the Head of the Agency or his/her Authorized Representative on the payment covered by the DV.
                    The approving officer shall affix his/her signature and indicate his/her name and position/designation, and the date of signing on the spaces provided.
                </li>
                <li>
                    Receipt of Payment (Bod E) – acknowledgement by the claimant or his/her duly authorized representative for the receipt of the check/ADA/cash and the date of receipt.  The claimant/payee shall affix his/her signature on the space provided and shall indicate the number and the date of the check, bank name and account number, and OR number and date other relevant documents issued to acknowledge the receipt of payment
                </li>
                <li>
                    JEB No. and Date – number and date of the JEV covering the DV
                </li>
            </ol>
            <li>
                The DVs shall be prepared in four (4) copies to be distributed as follows;
                <ul style="list-style-type: none">
                    <li>
                        Original – COA, through Accounting Division/Unit together with the supporting documents for submission to the Auditor for post audit
                        Documents for submission to the Auditor for post Audit
                    </li>
                    <li>
                        Copy 2   -  Cash Treasury/Unit
                    </li>
                    <li>
                        Copy 3   -  Accounting Division/Unit
                    </li>
                    <li>
                        Copy 4   -  Payee
                    </li>

                </ul>
            </li>
        </ol>
    </div>



</body>
</html>