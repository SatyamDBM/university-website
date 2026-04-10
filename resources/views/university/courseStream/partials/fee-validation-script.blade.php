
<script>
const minFee      = document.getElementById('min_fee');
const maxFee      = document.getElementById('max_fee');
const warningBox  = document.getElementById('warningBox');
const warningText = document.getElementById('warningText');

function validateFees() {
    if (minFee.value && maxFee.value && +minFee.value > +maxFee.value) {
        warningText.textContent = 'Min fee cannot be greater than max fee.';
        warningBox.classList.remove('hidden');
        warningBox.classList.add('flex');
    } else {
        warningBox.classList.add('hidden');
        warningBox.classList.remove('flex');
    }
}

minFee.addEventListener('input', validateFees);
maxFee.addEventListener('input', validateFees);

document.getElementById('streamForm').addEventListener('submit', function(e) {
    if (minFee.value && maxFee.value && +minFee.value > +maxFee.value) {
        e.preventDefault();
        warningText.textContent = 'Min fee cannot be greater than max fee.';
        warningBox.classList.remove('hidden');
        warningBox.classList.add('flex');
    }
});
</script>