<div>
    <!-- Enhanced CSS for Better Mobile Responsiveness and UI -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }

        .otp-wrapper {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }

        .otp-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 22px;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .otp-input:focus {
            border-color: #4CAF50;
            transform: scale(1.1);
            box-shadow: 0px 3px 10px rgba(76, 175, 80, 0.5);
        }

        button {
            padding: 12px 20px;
            margin-top: 15px;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 15px;
            font-size: 16px;
            color: red;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .otp-container {
                gap: 5px;
            }

            .otp-input {
                width: 42px;
                height: 42px;
                font-size: 20px;
            }

            button {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>

    <div class="otp-wrapper">
        <!-- Send OTP Button -->
        <button wire:click="sendOtp">Send OTP</button>

        <!-- OTP Input Fields -->
        <div class="otp-container">
            @foreach(range(0, 5) as $index)
            <input
                type="text"
                maxlength="1"
                class="otp-input"
                wire:model.defer="otp.{{ $index }}"
                @keydown="moveFocus($event, {{ $index }})"
                @input="moveFocus($event, {{ $index }})"
                @if($index==0) autofocus @endif>
            @endforeach
        </div>

        <!-- Verify OTP Button -->
        <button wire:click="verifyOtp">Verify OTP</button>

        @if ($message)
        <p>{{ $message }}</p>
        @endif
    </div>

    <!-- JavaScript for Auto Focus -->
    <script>
        function moveFocus(event, index) {
            const inputs = document.querySelectorAll('.otp-container input');

            // If the key is a digit, move focus to the next input
            if (/^\d$/.test(event.key)) {
                if (index < inputs.length - 1) {
                    if (inputs[index].value) {
                        inputs[index + 1].focus();
                    }
                }
            }

            // If the user presses backspace and the current input is empty, move focus to the previous input
            if (event.key === 'Backspace' && !inputs[index].value && index > 0) {
                inputs[index - 1].focus();
            }
        }
    </script>
</div>
