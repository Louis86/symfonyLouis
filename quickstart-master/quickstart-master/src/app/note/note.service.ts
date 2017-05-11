import { Injectable } from '@angular/core';
import { Headers, Http, Response, RequestOptions } from '@angular/http';
import { Observable} from 'rxjs/Rx';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';
import { NOTES } from '../verif-notes';
import { Note } from './note';

@Injectable()
export class NoteService {
  private notesUrl = 'http://localhost/webNote/noteWeb/web/app_dev.php/page/api';

  constructor(private http: Http) {}

  getNotes() { 
    const url = `${this.notesUrl}/notes`;
    return this.http.get(url)
      .map((res: Response) => res.json());
  }

  newNote(note: Note) {
    const cat_id = note.category.id;
    const url = `${this.notesUrl}/categories/${cat_id}/notes`;
    return this.http.post(url, JSON.stringify(note), {})
      .map((res: Response) => res.json());
  }

  updateNote(note: Note) {
    const note_id = note.id;
    const url = `${this.notesUrl}/notes/${note_id}`;
    return this.http.patch(url, JSON.stringify(note), {})
      .map((res: Response) => res.json());
  }

  deleteNote(note: Note) {
    const note_id = note.id;
    const url = `${this.notesUrl}/notes/${note_id}`;
    return this.http.delete(url, {})
      .map((res: Response) => res.json());
  }
}
