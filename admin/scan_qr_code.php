<script src="https://unpkg.com/html5-qrcode"></script>
<style>
    #reader {
  width: 100%;
  margin-top: 20px;
}

#result {
  margin-top: 20px;
  padding: 10px;
  border-top: 1px solid #ccc;
}

#output {
  font-weight: bold;
  color: green;
}

/* Style for all buttons inside the scanner */
#reader button {
  background-color: #4CAF50;   /* Green */
  color: white;
  border: none;
  padding: 5px 10px;
  margin: 10px 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

/* Hover effect */
#reader button:hover {
  background-color: #45a049;
}

/* Optional: style for select input (camera selection dropdown) */
#reader select {
  padding: 8px;
  font-size: 14px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin: 10px 5px;
}

</style>
  <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
          
    <div id="reader"></div>
    <div id="result">
      <p>Scanned Result:</p>
      <div id="output"></div>
    </div>
            </div>
        </div>
    </div>
  </div>

  <script>
    function onScanSuccess(decodedText, decodedResult) {
  // Handle the scanned code
  document.getElementById('output').innerText = decodedText;
}

function onScanFailure(error) {
  // Optional: Handle scan failure (e.g., log or show a message)
  console.warn(`Scan error: ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: 250 },  // Adjust fps and size
  false
);

html5QrcodeScanner.render(onScanSuccess, onScanFailure);

  </script>

