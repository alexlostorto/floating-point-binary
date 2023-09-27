
<style>
    #binary-section {
        display: block;
    }

    #binary section {
        display: flex;
        gap: inherit;
        align-items: center;
        justify-content: center;
    }

    .binary-inputs {
        padding-top: 2rem;
        height: min-content;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 1rem;
    }

    .binary-inputs input,
    .binary-inputs label {
        width: 100%;
    }

    .binary-inputs label {
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .binary-inputs input {
        text-align: center;
        padding: 0.1rem 0;
        border: 1px solid black;
        box-shadow: inset 0px 1px 5px rgba(0, 0, 0, 1);
    }

    .binary-inputs input::-webkit-inner-spin-button,
    .binary-inputs input::-webkit-outer-spin-button {
        /* Hide the inner and outer spin buttons */
        -webkit-appearance: none;
        appearance: none;
        margin: 0; /* Remove any margin that may be applied */
    }

    .binary-inputs div {
        display: flex;
        flex-direction: column;
        width: min-content;
        gap: 0.5rem;
    }

    .binary-inputs div label {
        padding: 0 0.6rem;
    }

    .buttons {
        justify-content: end;
        flex-direction: row !important;
    }

    .buttons button {
        border: none;
        align-items: center;
        justify-content: center;
        display: flex;
        padding: 0.4rem 0.8rem;
        background-color: black;
        border-radius: 10px;
    }

    .buttons button svg {
        fill: white;
    }

    .buttons button:hover {
        opacity: 0.6;
    }

    #subtract-binary-right {
        display: none;
    }
</style>

<section id="binary-section">
    <div id="binary" class="binary-inputs">
        <div class="buttons">
            <button id="add-binary-left">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                </svg>
            </button>
            <button id="subtract-binary-left">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/>
                </svg>
            </button>
        </div>
        <section>
            <div>
                <label for="binary-1024">-1024</label>
                <input id="binary-1024" type="number">
            </div>
            <div>
                <label for="binary-512">512</label>
                <input id="binary-512" type="number">
            </div>
            <div>
                <label for="binary-256">256</label>
                <input id="binary-256" type="number">
            </div>
            <div>
                <label for="binary-128">128</label>
                <input id="binary-128" type="number">
            </div>
            <div>
                <label for="binary-64">64</label>
                <input id="binary-64" type="number">
            </div>
            <div>
                <label for="binary-32">32</label>
                <input id="binary-32" type="number">
            </div>
            <div>
                <label for="binary-16">16</label>
                <input id="binary-16" type="number">
            </div>
            <div>
                <label for="binary-8">8</label>
                <input id="binary-8" type="number">
            </div>
            <div>
                <label for="binary-4">4</label>
                <input id="binary-4" type="number">
            </div>
            <div>
                <label for="binary-2">2</label>
                <input id="binary-2" type="number">
            </div>
            <div>
                <label for="binary-1">1</label>
                <input id="binary-1" type="number">
            </div>
        </section>
        <div class="buttons">
            <button id="subtract-binary-right">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/>
                </svg>
            </button>
            <button id="add-binary-right">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<script>

const addBinaryLeft = document.querySelector("#add-binary-left");
const subtractBinaryLeft = document.querySelector("#subtract-binary-left");
const addBinaryRight = document.querySelector("#add-binary-right");
const subtractBinaryRight = document.querySelector("#subtract-binary-right");

document.querySelectorAll("#binary input").forEach(binaryInput => {
    binaryInput.addEventListener("input", updateOutput);
});

document.querySelector("#add-binary-left").addEventListener("click", () => {
    const mostSignificantBit = document.querySelector("#binary label").textContent.replace("-", "");
    document.querySelector("#binary label").textContent = mostSignificantBit;
    newBinaryInput = createInput("-" + mostSignificantBit * 2);

    const firstChild = document.querySelector("#binary section").firstChild;
    document.querySelector("#binary section").insertBefore(newBinaryInput, firstChild);

    if (window.getComputedStyle(document.querySelector("#subtract-binary-left")).getPropertyValue('display') == "none") {
        document.querySelector("#subtract-binary-left").style.display = "flex";
    }

    updateOutput();
});

document.querySelector("#subtract-binary-left").addEventListener("click", () => {
    if (document.querySelectorAll("#binary section div").length == 1) return;

    document.querySelector("#binary section div").remove();
    mostSignificantBit = document.querySelector("#binary section label").textContent;
    document.querySelector("#binary section label").textContent = "-" + mostSignificantBit;

    if (mostSignificantBit == "1") {
        document.querySelector("#subtract-binary-left").style.display = "none";
    }

    updateOutput();
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
        document.querySelector("#subtract-binary-right").style.display = "flex";
    }

    updateOutput();
});

document.querySelector("#subtract-binary-right").addEventListener("click", () => {
    if (document.querySelectorAll("#binary section div").length == 1) return;
    
    leastSignificantBit = document.querySelector("#binary section").lastElementChild;
    leastSignificantBit.remove();
    if (leastSignificantBit.querySelector("label").textContent == "1/2") {
        document.querySelector("#subtract-binary-right").style.display = "none";
    }

    updateOutput();
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

function calculateBinary() {
    const binaryInputs = document.querySelectorAll("#binary input");
    const binaryLabels = document.querySelectorAll("#binary label");
    let output = 0;

    for (i=0; i<binaryInputs.length; i++) {
        output += binaryInputs[i].value * eval(binaryLabels[i].textContent);
    }

    return output;
}

function updateOutput() {
    if (window.getComputedStyle(document.querySelector("#binary-section")).getPropertyValue('display') == "block") {
        const binary = calculateBinary();
        document.querySelector("#value").textContent = binary;
    } else {
        const mantissa = calculateMantissa();
        const exponent = calculateExponent();
        output = mantissa * Math.pow(2, exponent);
        document.querySelector("#value").textContent = output;
    }
}

</script>