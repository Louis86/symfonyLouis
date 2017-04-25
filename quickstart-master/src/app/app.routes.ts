import { Routes } from '@angular/router';
import { HomeComponent } from './home.component';
import { NoteComponent } from './note.component';
import { CategorieComponent } from './categorie.component';

export const ROUTES: Routes = [
    { path: '', redirectTo:'home', pathMatch: 'full' },
    { path: 'home',  component: HomeComponent },
    { path: 'note',  component: NoteComponent },
    { path: 'categorie', component:CategorieComponent }
];