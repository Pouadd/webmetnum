<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gauss-Jordan Solver</title>
    <link rel="stylesheet" href="{{ asset('css/estimasi.css') }}">

        
</head>
<body>
    <div class="container">
        <h1>Gauss-Jordan Solver</h1>
        <form id="gaussJordanForm">
            <div class="form-group">
                <label for="matrixInput">Enter Matrix (comma-separated, rows by semicolons):</label>
                <input type="text" id="matrixInput" placeholder="e.g., 2,1,-1,8; -3,-1,2,-11; -2,1,2,-3" required>
            </div>
            <button type="button" onclick="solveMatrix()">Solve</button>
            <a href="{{ url('/') }}">kembali</a>
        </form>
        <div class="result" id="result"></div>
    </div>

    <script>
        function parseMatrix(input) {
            return input.split(';').map(row => row.split(',').map(Number));
        }

        function gaussJordan(matrix) {
            const rows = matrix.length;
            const cols = matrix[0].length;

            for (let i = 0; i < rows; i++) {
                // Make the diagonal element 1
                let diag = matrix[i][i];
                for (let j = 0; j < cols; j++) {
                    matrix[i][j] /= diag;
                }

                // Make all other elements in column i zero
                for (let k = 0; k < rows; k++) {
                    if (k !== i) {
                        let factor = matrix[k][i];
                        for (let j = 0; j < cols; j++) {
                            matrix[k][j] -= factor * matrix[i][j];
                        }
                    }
                }
            }

            return matrix.map(row => row[cols - 1]); // Extract solutions
        }

        function solveMatrix() {
            const input = document.getElementById('matrixInput').value;
            try {
                const matrix = parseMatrix(input);
                const solution = gaussJordan(matrix);

                const resultDiv = document.getElementById('result');
                resultDiv.innerHTML = `
                    <p><strong>Solution:</strong></p>
                    <p>${solution.map((x, i) => `x${i + 1} = ${x.toFixed(2)}`).join('<br>')}</p>
                `;
            } catch (error) {
                alert("Invalid matrix input. Please check the format.");
            }
        }
    </script>
</body>
</html> -->
