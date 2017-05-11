import { Component, OnInit, Input } from '@angular/core';
import { CATEGORIES } from '../verif-categories';
import { NOTES } from '../verif-notes';
import { Category } from '../categorie/category';
import { Note } from './note';
import { NoteService } from './note.service';
import { CategoryService } from '../categorie/category.service';

@Component({
  selector: 'my-notes',
  templateUrl: './app/note/notes.component.html',
})

export class NotesComponent implements OnInit { 
  title = 'Notepad';

  //@Input() notes = NOTES;
  notes = NOTES;
  categories = CATEGORIES;
  note_edited = -1;
  new_note: Note = null;
  private  ntes: any;
  private catgls:any;

  constructor(
    private note_service: NoteService,
    private category_service: CategoryService) {
  }

  getNotes(): void {
    this.note_service.getNotes().subscribe(
      // function that runs on success
      data => { this.notes = data},
      // function that runs on error
      err => console.error(err),
      // function that runs on completion
      //() => console.log(this.notes)
      null
    );
  }

  getCategories(): void {
    this.category_service.getCategories().subscribe(
      // function that runs on success
      data => { this.categories = data},
      // function that runs on error
      err => console.error(err),
      // function that runs on completion
      //() => console.log(this.categories)
      null
    );
  }

  validate(note: Note) {
    console.log(note);
    this.note_edited = -1;
  }

  newNote(note: Note) {
    this.note_service.newNote(note).subscribe(
      data => { this.notes.unshift(data) },
      err => console.error(err),
      () => { this.new_note = null }
    );
  }

  updateNote(note: Note, index: number): void {
    this.note_service.updateNote(note).subscribe(
      data => { this.notes[index] = data},
      err => console.error(err),
      () => { this.note_edited = -1; }
    );
  }

  deleteNote(note: Note, index: number) {
    this.note_service.deleteNote(note).subscribe(
      data => { this.notes.splice(index, 1) },
      err => console.error(err),
      () => { }
    );
  }

  initNewNote() {
    this.new_note = new Note();

    this.category_service.getCategories().subscribe(
        // function that runs on success
        data => { this.catgls = data},
        // function that runs on error
        err => console.error(err),
        // function that runs on completion
        //() => console.log(this.categories)
        null
    );
    
    
    
    
    
    
    
    
  }

  deleteNewNote() {
    this.new_note = null;
  }

  ngOnInit(): void {
    //this.getNotes();
    //this.getCategories();
    //getCategories();
    this.note_service.getNotes().subscribe(
        // function that runs on success
        data => { this.ntes = data},
        // function that runs on error
        err => console.error(err),
        // function that runs on completion
        //() => console.log(this.notes)
        null);
    console.log(this.ntes);
  }
  
}
