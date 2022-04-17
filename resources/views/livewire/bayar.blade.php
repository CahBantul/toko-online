<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($belanja->status== 1)
                <div class="row">
                    <div class="col-md-12">
                        <button id="pay-button" type="button" class="btn btn-primary center-block">Pay!</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div>
    <form action="Payment" id="payment-form" method="get">
        <input type="hidden" name="result_data" id="result-data" value="">
    </form>
</div>
</body>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-server-c00h6kLItx1W2davwCDO19T5"></script>

<script type="text/javascript">

</script>