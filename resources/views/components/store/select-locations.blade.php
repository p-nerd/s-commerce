@props([
    'divisions',
    'division',
    'district',
])

<div class="row">
    <div class="form-group col-lg-6">
        <label for="select-division">Select Division *</label>
        <select
            class="form-control"
            id="select-division"
            name="division"
            value="{{ old('division') ?? $division }}"
            required
            disabled
        >
            <option selected>Select Division *</option>
        </select>
        @error('division')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-lg-6">
        <label for="select-district">Select District *</label>
        <select
            class="form-control"
            value="{{ old('district') ?? $district }}"
            id="select-district"
            name="district"
            required
            disabled
            data-divisions="{{ $divisions }}"
        >
            <option selected>Select District</option>
        </select>
        @error('district')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectDivision = document.querySelector('#select-division');
        const selectDistrict = document.querySelector('#select-district');

        const setupLocationsSelectEventListener = () => {
            const data = selectDistrict.getAttribute('data-divisions');
            const divisions = JSON.parse(data);

            const divisionValue = selectDivision.getAttribute('value');

            divisions.forEach(({ label, value }, index) => {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = label;
                if (divisionValue === value) {
                    option.selected = true;
                }

                selectDivision.appendChild(option);

                if (index === divisions.length - 1) {
                    selectDivision.disabled = false;
                }
            });

            const division = divisions.find((d) => d.value == divisionValue);

            division?.districts?.forEach(({ label, value }, index) => {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = label;
                if (selectDistrict.getAttribute('value') === value) {
                    option.selected = true;
                }

                selectDistrict.appendChild(option);

                if (index === division?.districts.length - 1) {
                    selectDistrict.disabled = false;
                }
            });

            selectDivision.addEventListener('change', function (event) {
                selectDistrict.disabled =
                    event.target.value == '' ? true : false;

                const division = divisions.find(
                    (d) => d.value == event.target.value,
                );

                selectDistrict.innerHTML = '';

                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Select District';
                selectDistrict.appendChild(option);

                division.districts?.forEach(({ label, value }) => {
                    const option = document.createElement('option');
                    option.value = value;
                    option.textContent = label;
                    selectDistrict.appendChild(option);
                });
            });
        };

        setupLocationsSelectEventListener();
    });
</script>
