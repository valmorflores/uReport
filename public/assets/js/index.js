
// Func for dark-mode (enable, disable)
const $html = document.querySelector('html')
const $checkboxDark = document.querySelector('#switch')
let data = sessionStorage.getItem('dark-mode');
if (data=='true'){
    if ( ! $html.classList.contains('dark-mode')){
        $html.classList.toggle('dark-mode') 
    }
    $checkboxDark.checked=true;
}
else
{
    if ( $html.classList.contains('dark-mode')){
      $html.classList.toggle('dark-mode') 
    }
    $checkboxDark.checked=false;
}

/*if ($checkboxDark.checked){
    $html.classList.add('dark-mode');
}*/

$checkboxDark.addEventListener('change', function(){
    
    $html.classList.toggle('dark-mode')
    sessionStorage.setItem('dark-mode', $html.classList.contains('dark-mode'))
    // Save data to sessionStorage
   // console.log('toggle change:' + $html.classList.contains('dark-mode'))
     
})
