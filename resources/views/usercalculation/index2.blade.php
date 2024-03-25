<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>
    <h1>Calculator</h1>

    <form id="calculationForm" method="POST" action="{{ route('usercalculation.calculate') }}">
        @csrf
        <label for="num1">Number 1:</label><br>
        <input type="number" id="num1" name="num1"><br>

        <label for="num2">Number 2:</label><br>
        <input type="number" id="num2" name="num2"><br>

        <button type="submit">Calculate</button>
    </form>

    <h2 id="result"></h2>

    <script>
        document.getElementById('calculationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var number1 = parseFloat(document.getElementById('num1').value);
            var number2 = parseFloat(document.getElementById('num2').value);

            var result = number1 + number2;

            document.getElementById('result').innerText = 'Result: ' + result;
        });
    </script>
</body>
</html>
