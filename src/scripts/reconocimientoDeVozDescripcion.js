const $descripcion = document.querySelector('#descripButton')
const $text2 = document.querySelector('#inDesc')
const tdescripcion=()=>{
	
	const iniciar = (e) => {
		
		for (i = e.resultIndex; i < e.results.length; i++) {
			$text2.value = e.results[i][0].transcript
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
    

}


//$descripcion.addEventListener('click',tdescripcion)
