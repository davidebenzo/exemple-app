@if ($logo === 'fashion')
<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
    <path d="M50 20 Q40 40 50 60 Q60 40 50 20 Z" stroke="black" fill="none" stroke-width="3"/>
    <line x1="45" y1="60" x2="45" y2="75" stroke="black" stroke-width="3"/>
    <line x1="55" y1="60" x2="55" y2="75" stroke="black" stroke-width="3"/>
    <circle cx="50" cy="10" r="5" fill="black"/>
</svg>

@elseif ($logo === 'travel')
<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
    <rect x="25" y="30" width="50" height="40" rx="5" stroke="black" fill="none" stroke-width="3"/>
    <circle cx="35" cy="75" r="5" fill="black"/>
    <circle cx="65" cy="75" r="5" fill="black"/>
    <line x1="35" y1="30" x2="35" y2="20" stroke="black" stroke-width="3"/>
    <line x1="65" y1="30" x2="65" y2="20" stroke="black" stroke-width="3"/>
</svg>

@elseif ($logo === 'finance')
<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
    <rect x="30" y="30" width="40" height="40" rx="5" stroke="black" fill="none" stroke-width="3"/>
    <line x1="30" y1="50" x2="70" y2="50" stroke="black" stroke-width="3"/>
    <circle cx="50" cy="50" r="10" fill="black"/>
</svg>
@elseif ($logo === 'technology')
<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
    <rect x="20" y="20" width="60" height="60" rx="10" stroke="black" fill="none" stroke-width="4"/>
    <circle cx="35" cy="35" r="5" fill="black"/>
    <circle cx="65" cy="65" r="5" fill="black"/>
    <line x1="35" y1="35" x2="65" y2="65" stroke="black" stroke-width="3"/>
    <line x1="50" y1="35" x2="65" y2="50" stroke="black" stroke-width="3"/>
</svg>
@elseif ($logo === 'food-drink')
<svg class="{{ $class }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
    <circle cx="50" cy="30" r="15" stroke="black" fill="none" stroke-width="3"/>
    <line x1="40" y1="45" x2="60" y2="45" stroke="black" stroke-width="3"/>
    <rect x="35" y="45" width="30" height="30" rx="5" fill="none" stroke="black" stroke-width="3"/>
</svg>
@endif
