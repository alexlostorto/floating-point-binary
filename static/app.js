const denaryOutput = document.querySelector("#value");
const convertButton = document.querySelector(".convert input");

const addBinaryLeft = document.querySelector("#add-binary-left");
const subtractBinaryLeft = document.querySelector("#subtract-binary-left");
const addBinaryRight = document.querySelector("#add-binary-right");
const subtractBinaryRight = document.querySelector("#subtract-binary-right");

document.querySelectorAll("#binary input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

document.querySelectorAll("#mantissa input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

document.querySelectorAll("#exponent input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

document.querySelector("#add-binary-left").addEventListener("click", () => {
    const mostSignificantBit = document.querySelector("#binary label").textContent.replace("-", "");
    document.querySelector("#binary label").textContent = mostSignificantBit;
    newBinaryInput = createInput("-" + mostSignificantBit * 2);

    const firstChild = document.querySelector("#binary section").firstChild;
    document.querySelector("#binary section").insertBefore(newBinaryInput, firstChild);

    if (window.getComputedStyle(document.querySelector("#subtract-binary-left")).getPropertyValue('display') == "none") {
        document.querySelector("#subtract-binary-left").style.display = "block";
    }
});

document.querySelector("#subtract-binary-left").addEventListener("click", () => {
    if (document.querySelectorAll("#binary section div").length == 1) return;

    document.querySelector("#binary section div").remove();
    mostSignificantBit = document.querySelector("#binary section label").textContent;
    document.querySelector("#binary section label").textContent = "-" + mostSignificantBit;

    if (mostSignificantBit == "1") {
        document.querySelector("#subtract-binary-left").style.display = "none";
    }
});

document.querySelector("#add-binary-right").addEventListener("click", () => {
    const parentElement = document.querySelector("#binary section").lastElementChild;
    const leastSignificantBit = parentElement.querySelector("label").textContent.replace("-", "");
    let fraction;

    if (leastSignificantBit == 1) {
        fraction = [1, 1];
    } else {
        fraction = leastSignificantBit.split('/');
    }

    newBinaryInput = createFractionalInput(fraction[0] + "/" + fraction[1] * 2);
    document.querySelector("#binary section").appendChild(newBinaryInput);

    if (window.getComputedStyle(document.querySelector("#subtract-binary-right")).getPropertyValue('display') == "none") {
        document.querySelector("#subtract-binary-right").style.display = "block";
    }
});

document.querySelector("#subtract-binary-right").addEventListener("click", () => {
    if (document.querySelectorAll("#binary section div").length == 1) return;
    
    leastSignificantBit = document.querySelector("#binary section").lastElementChild;
    leastSignificantBit.remove();
    if (leastSignificantBit.querySelector("label").textContent == "1/2") {
        document.querySelector("#subtract-binary-right").style.display = "none";
    }
});

function createInput(value) {
    const container = document.createElement("div");

    const label = document.createElement("label");
    label.for = `binary-${value.replace("-", "")}`;
    label.textContent = value;

    const input = document.createElement("input");
    input.type = "number";
    input.id = `binary-${value.replace("-", "")}`;
    input.addEventListener("input", updateOutput);

    container.appendChild(label);
    container.appendChild(input);

    return container;
}

function createFractionalInput(value) {
    const container = document.createElement("div");

    const fraction = value.replace("-", "").split('/');
    const className = `${fraction[0]}-over-${fraction[1]}`;

    const label = document.createElement("label");
    label.for = `binary-${className}`;
    label.textContent = value;

    const input = document.createElement("input");
    input.type = "number";
    input.id = `binary-${className}`;
    input.addEventListener("input", updateOutput);

    container.appendChild(label);
    container.appendChild(input);

    return container;
}

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
        mantissaInputs[i].value = binaryValues[i];
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
        updateOutput();
    }
})
