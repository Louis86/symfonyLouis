import { Component } from '@angular/core';
import { Hero }    from '../note';
@Component({
    selector: 'note-form',
    templateUrl: '../note.component.html'
})
export class NoteFormComponent {
    categorie = ['categorie1', 'categorie2'];
    model = new Note(18, 'Titre1', this.notes[0], '');
    submitted = false;
    onSubmit() { this.submitted = true; }
    newHero() {
        this.model = new Note(1, '', '');
    }
}