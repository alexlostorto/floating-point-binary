const denaryOutput = document.querySelector("#value");
const convertButton = document.querySelector(".convert input");

document.querySelectorAll("#binary input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

document.querySelectorAll("#mantissa input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

document.querySelectorAll("#exponent input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

function updateOutput() {
    if (window.getComputedStyle(document.querySelector("#binary-section")).getPropertyValue('display') == "block") {
        const binary = calculateBinary();
        denaryOutput.textContent = binary;
    } else {
        const mantissa = calculateMantissa();
        const exponent = calculateExponent();
        output = mantissa * Math.pow(2, exponent);
        denaryOutput.textContent = output;
    }
}

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

function calculateBinary() {
    const binaryInputs = document.querySelectorAll("#binary input");
    const binaryLabels = document.querySelectorAll("#binary label");
    let output = 0;

    for (i=0; i<binaryInputs.length; i++) {
        output += binaryInputs[i].value * eval(binaryLabels[i].textContent);
    }

    return output;
}

function updateMantissa() {
    const binary = [...document.querySelectorAll("#binary-section input")].map(element => element.value);
    const mantissaInputs = document.querySelectorAll("#mantissa input");
    const exponent = binary.length - 1;

    for (i=0; i<binary.length; i++) {
        mantissaInputs[i].value = binary[i];
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

convertButton.addEventListener("change", () => {
    if (convertButton.checked) {
        document.querySelector("#binary-section").style.display = "none";
        document.querySelector("#mantissa-section").style.display = "block";
        updateMantissa();
        updateOutput();
    } else {
        document.querySelector("#binary-section").style.display = "block";
        document.querySelector("#mantissa-section").style.display = "none";
    }
})
