const mantissaInputs = document.querySelectorAll("#mantissa input");
const exponentInputs = document.querySelectorAll("#exponent input");
const binaryOutput = document.querySelector("#value");

mantissaInputs.forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

exponentInputs.forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

function updateOutput() {
    const mantissa = calculateMantissa();
    const exponent = calculateExponent();

    output = mantissa * Math.pow(2, exponent);

    binaryOutput.textContent = output;
}

function calculateExponent() {
    const binaryValues = [-16, 8, 4, 2, 1];
    let output = 0;

    for (i=0; i<exponentInputs.length; i++) {
        output += exponentInputs[i].value * binaryValues[i];
    }

    return output;
}

function calculateMantissa() {
    const binaryValues = [-1, 1/2, 1/4, 1/8, 1/16, 1/32, 1/64, 1/128];
    let output = 0;

    for (i=0; i<mantissaInputs.length; i++) {
        output += mantissaInputs[i].value * binaryValues[i];
    }

    return output;
}