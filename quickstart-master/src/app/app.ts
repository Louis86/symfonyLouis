import {
    FormsModule,
    ReactiveFormsModule
} from '@angular/forms';

// farther down...

@NgModule({
    declarations: [
        FormsDemoApp,
        DemoFormSku,
        // ... our declarations here
    ],
    imports: [
        BrowserModule,
        FormsModule,         // <-- add this
        ReactiveFormsModule  // <-- and this
    ],
    bootstrap: [ FormsDemoApp ]
})
class FormsDemoAppModule {}