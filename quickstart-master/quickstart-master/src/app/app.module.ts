import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes } from '@angular/router';
import { LocationStrategy, HashLocationStrategy} from '@angular/common';

import { AppComponent }  from './app.component';
import { NotesComponent } from './note/notes.component';
import { CategoriesComponent } from './categorie/categories.component';
import { NoteService } from './note/note.service';
import { CategoryService } from './categorie/category.service';

const appRoutes: Routes = [
  { path: 'notes', component: NotesComponent },
  { path: 'categories', component: CategoriesComponent },
  { path: '', redirectTo: '/notes', pathMatch: 'full' },
];

@NgModule({
  imports:      [ 
    BrowserModule,
    FormsModule,
    HttpModule,
    RouterModule.forRoot(appRoutes),
  ],
  declarations: [ 
    AppComponent,
    NotesComponent,
    CategoriesComponent,
  ],
  providers: [
    NoteService,
    CategoryService,
    {provide: LocationStrategy, useClass: HashLocationStrategy}
  ],
  bootstrap: [ 
    AppComponent,
  ],
})

export class AppModule { }
