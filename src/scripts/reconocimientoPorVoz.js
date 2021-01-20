const $titulo = document.querySelector('#titleButton')
const $descripcion = document.querySelector('#descripButton')
var text=''
//const $text=document.querySelector('inTitulo')
const $text = document.querySelector('#inTitulo')
const iniciar = (e) => {
    
	for (i = e.resultIndex; i < e.results.length; i++) {
		$text.value = e.results[i][0].transcript
	}
}
if(!('webkitSpeechRecognition' in window)){
    alert('No se puede usar la api para reconocimiento de voz');
}else{
    //alert('si puede usar la api');
    rec = new webkitSpeechRecognition()
	rec.lang = 'es-PE'
	rec.continuous = true
	rec.interim = true
	rec.addEventListener('result', iniciar)
	rec.start()
}

const Ttitulo=()=>{
    
}
const tdescripcion=()=>{

}
$titulo.addEventListener('click', Ttitulo)
$descripcion.addEventListener('click',tdescripcion)