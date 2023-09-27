<style>
    #mantissa-section {
        display: none;
    }
</style>

<section id="mantissa-section">
    <div id="mantissa" class="binary-inputs">
        <div>
            <label for="binary-1">-1</label>
            <input id="binary-1" type="number">
        </div>
        <div>
            <label for="binary-1-over-2">1/2</label>
            <input id="binary-1-over-2" type="number">
        </div>
        <div>
            <label for="binary-1-over-4">1/4</label>
            <input id="binary-1-over-4" type="number">
        </div>
        <div>
            <label for="binary-1-over-8">1/8</label>
            <input id="binary-1-over-8" type="number">
        </div>
        <div>
            <label for="binary-1-over-16">1/16</label>
            <input id="binary-1-over-16" type="number">
        </div>
        <div>
            <label for="binary-1-over-32">1/32</label>
            <input id="binary-1-over-32" type="number">
        </div>
        <div>
            <label for="binary-1-over-64">1/64</label>
            <input id="binary-1-over-64" type="number">
        </div>
        <div>
            <label for="binary-1-over-128">1/128</label>
            <input id="binary-1-over-128" type="number">
        </div>
        <div>
            <label for="binary-1-over-256">1/256</label>
            <input id="binary-1-over-256" type="number">
        </div>
        <div>
            <label for="binary-1-over-512">1/512</label>
            <input id="binary-1-over-512" type="number">
        </div>
        <div>
            <label for="binary-1-over-1024">1/1024</label>
            <input id="binary-1-over-1024" type="number">
        </div>
    </div>
    <div id="exponent" class="binary-inputs">
        <div>
            <label for="exponent-16">-16</label>
            <input id="exponent-16" type="number">
        </div>
        <div>
            <label for="exponent-8">8</label>
            <input id="exponent-8" type="number">
        </div>
        <div>
            <label for="exponent-4">4</label>
            <input id="exponent-4" type="number">
        </div>
        <div>
            <label for="exponent-2">2</label>
            <input id="exponent-2" type="number">
        </div>
        <div>
            <label for="exponent-1">1</label>
            <input id="exponent-1" type="number">
        </div>
    </div>
</section>

<script>

document.querySelectorAll("#mantissa input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

document.querySelectorAll("#exponent input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

function calculateExponent() {
    const exponentInputs = document.querySelectorAll("#exponent input");
    const exponentLabels = document.querySelectorAll("#exponent label");
    let output = 0;

    for (i=0; i<exponentInputs.length; i++) {
        output += exponentInputs[i].value * eval(exponentLabels[i].textContent);
    }

    return output;
}

function calculateMantissa() {
    const mantissaInputs = document.querySelectorAll("#mantissa input");
    const mantissaLabels = document.querySelectorAll("#mantissa label");
    let output = 0;

    for (i=0; i<mantissaInputs.length; i++) {
        output += mantissaInputs[i].value * eval(mantissaLabels[i].textContent);
    }

    return output;
}

function updateMantissa() {
    const binaryValues = [...document.querySelectorAll("#binary-section input")].map(element => element.value);
    const binaryLabels = [...document.querySelectorAll("#binary-section label")].map(element => element.textContent);
    let exponent = -1;

    binaryLabels.forEach((element, _) => {
        if (!(element.includes("/"))) {
            exponent += 1;
        }
    })

    while (binaryValues.length > document.querySelectorAll("#mantissa input").length) {
        const parentElement = document.querySelector("#mantissa").lastElementChild;
        const leastSignificantBit = parentElement.querySelector("label").textContent.replace("-", "");
        const fraction = leastSignificantBit.split('/');
    
        newBinaryInput = createFractionalInput(fraction[0] + "/" + fraction[1] * 2);
        document.querySelector("#mantissa").appendChild(newBinaryInput);
    }

    const mantissaInputs = document.querySelectorAll("#mantissa input");

    for (i=0; i<binaryValues.length; i++) {
        mantissaInputs[i].value = binaryValues[i] >= 1 ? binaryValues[i] : 0;
    }

    updateExponent(exponent);
}

function updateExponent(exponent) {
    binaryValue = convertToTwosComplement(exponent);
    const exponentInputs = document.querySelectorAll("#exponent input");

    for (i=0; i<binaryValue.length; i++) {
        exponentInputs[i].value = binaryValue[i];
    }
}

function convertToTwosComplement(decimal) {
    let binaryValue = [0, 0, 0, 0, 0];

    if (decimal < -16 || decimal > 15) {
        alert("Decimal exponent out of range for 5-bit two's complement representation.");
        return binaryValue;
    }

    if (decimal < 0) {
        decimal = decimal + 16;
    }

    let counter = 4;
    
    while (decimal > 0) {
        binaryValue[counter] = decimal % 2 == 1 ? 1 : 0;
        decimal = Math.floor(decimal / 2);
        counter --;
    }

    return binaryValue;
}

</script>