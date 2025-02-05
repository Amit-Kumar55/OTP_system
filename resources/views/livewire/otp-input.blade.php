<div class="otp-container">
    <input type="text" maxlength="1" class="otp-input" x-ref="otp1" x-model="otp[0]" @input="$refs.otp2.focus()">
    <input type="text" maxlength="1" class="otp-input" x-ref="otp2" x-model="otp[1]" @input="$refs.otp3.focus()">
    <input type="text" maxlength="1" class="otp-input" x-ref="otp3" x-model="otp[2]" @input="$refs.otp4.focus()">
    <input type="text" maxlength="1" class="otp-input" x-ref="otp4" x-model="otp[3]" @input="$refs.otp5.focus()">
    <input type="text" maxlength="1" class="otp-input" x-ref="otp5" x-model="otp[4]" @input="$refs.otp6.focus()">
    <input type="text" maxlength="1" class="otp-input" x-ref="otp6" x-model="otp[5]" 
           @input="$nextTick(() => $wire.verifyOtp(otp.join('')))">
</div>

<script>
    document.querySelectorAll('.otp-input').forEach((input, index, inputs) => {
        input.addEventListener('paste', (e) => {
            const data = e.clipboardData.getData('text');
            if (/^\d{6}$/.test(data)) {
                data.split('').forEach((num, i) => inputs[i].value = num);
                inputs[5].dispatchEvent(new Event('input'));
            }
        });
    });
</script>
