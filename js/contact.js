export default class Formulaire {
    constructor(id) {
        this.id = id;
        this.form = document.getElementById(this);
        this.formdata = new FormData(this.formHTML);
    }
    }