<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {  /* Hide default HTML checkbox */
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: white;
        box-shadow: 0 0 10px black;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: black;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: black;
        box-shadow: 0 0 10px black;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        background-color: white;
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<div class="convert pt-4 d-flex align-items-center justify-content-center">
    <span class="convert-text px-3">Binary</span>
    <label class="switch">
        <input type="checkbox">
        <span class="slider round"></span>
    </label>
    <span class="convert-text px-3">Mantissa</span>
</div>

<script>

const convertButton = document.querySelector(".convert input");

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

</script>