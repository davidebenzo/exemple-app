@props([
    'regions'=>$regions
    ])

<div x-data="">
        

       
        <p x-show="selectedProvince">
            Hai selezionato la province: <strong x-text="getSelectedProvinceName()"></strong>
        </p>
    </div>