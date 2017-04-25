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

noteService: noteService;
recentlyWatchNote: note[];
nbOfNote: note;

constructor(noteService){
    this.noteService.ajouterNote(note);
}

ajouterNote(fromValue){

    console.log(formValue);
    // this.noteService.ajouterNote(note);
   // this.nbOfNote = this.recentlyWatchNote.length;
}

ngOnInit(){
    this.recentlyWatchNote = this.noteService.getAllNote();
    this.nbOfNote = this.recentlyWatchNote.length;
}