<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($belanja->status== 1)
                <div class="row">
                    <div class="col-md-12">
                        <button id="pay-button" type="button" class="btn btn-primary center-block">Pay!</button>
                    </div>
                </div>
            @elseif($belanja->status== 2)
                <div class="card">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <table class="table" style="border-top : hidden">
                                    <tr>
                                        <td>Virtual Akun</td>
                                        <td>:</td>
                                        <td>{{ $va_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bank</td>
                                        <td>:</td>
                                        <td>{{ $bank }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td>:</td>
                                        <td>{{ $gross_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>{{ $transaction_status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Batas Waktu Pembayaran</td>
                                        <td>:</td>
                                        <td>{{ $deadline }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-bR_xJPpR6FPb47Ze"></script>

<script type="text/javascript">
 // For example trigger on button clicked, or any time you need
 const payButton = document.getElementById('pay-button');
 const resultData = document.getElementById('result-data');
 const paymentForm = document.getElementById('payment-form');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('<?= $snapToken ?>', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
            resultData.value = JSON.stringify(result);
            paymentForm.submit();
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); 
            resultData.value = JSON.stringify(result);
            paymentForm.submit();
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });
</script>