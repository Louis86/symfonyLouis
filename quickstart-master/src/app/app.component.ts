import { Component } from '@angular/core';

import { FormGroup, FormControl, FormBuilder, Validators } from '@angular/forms';

import { User } from './user.interface';

@Component({
    moduleId: module.id,
    selector: 'my-app',
    templateUrl: 'app.component.html',
})
export class AppComponent implements OnInit {
    public myForm: FormGroup; // our model driven form
    public submitted: boolean; // keep track on whether form is submitted
    public events: any[] = []; // use later to display form changes

    constructor(private _fb: FormBuilder) { } // form builder simplify form initialization

    ngOnInit() {

        // the long way
        this.myForm = new FormGroup({
            name: new FormControl('', [<any>Validators.required, <any>Validators.minLength(5)]),
            address: new FormGroup({
                street: new FormControl('', <any>Validators.required),
                postcode: new FormControl('8000')
            })
        });

    }
    

    save(model: User, isValid: boolean) {
        this.submitted = true; // set form submit to true

        // check if model is valid
        // if valid, call API to save customer
        console.log(model, isValid);
    }
}


/**
@Component({
    selector: 'my-app',
 /**   template: `
  <nav>
    <a routerLink="/home" >Accueil</a>
    <a routerLink="/note" >Note</a>
    <a routerLink="/categorie" >Categorie</a>
  </nav>
  <router-outlet></router-outlet>`
    ,
    template: `<h1>Hello {{name}}</h1>`,
})

export class AppComponent  { name = 'Angular';}

**/