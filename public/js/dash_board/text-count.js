class Counter{
    constructor(counterId, maxlength, textareaId){
        this.counter = document.getElementById(counterId);
        this.maxlength = maxlength;
        this.textarea = document.getElementById(textareaId);
        this.textarea.onkeyup = this.count;
    }
    count(event){
        let textLength = counter.textarea.value.length;
        counter.counter.innerHTML = `${textLength}/${counter.maxlength}`;
    }

}

// This class must be called 'counter' as a variable 
let counter = new Counter('counter', 500, 'anuncio_descripcion');