import { Injectable } from '@angular/core';import { CATEGORIES } from '../verif-categories';
import { Headers, Http, Response, RequestOptions } from '@angular/http';
import { Observable} from 'rxjs/Rx';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

import { Category } from './category';


@Injectable()
export class CategoryService {
  private notesUrl = 'http://localhost:8070/notepad/api';

  constructor(private http: Http) {}

  getCategories() { 
    const url = `${this.notesUrl}/categories`;
    return this.http.get(url)
      .map((res: Response) => res.json());
  }

  newCategory(category: Category) {
    const url = `${this.notesUrl}/categories`;
    return this.http.post(url, JSON.stringify(category), {})
      .map((res: Response) => res.json());
  }

  updateCategory(category: Category) {
    const cat_id = category.id;
    const url = `${this.notesUrl}/categories/${cat_id}`;
    return this.http.patch(url, JSON.stringify(category), {})
      .map((res: Response) => res.json());
  }

  deleteCategory(category: Category) {
    const cat_id = category.id;
    const url = `${this.notesUrl}/categories/${cat_id}`;
    return this.http.delete(url, {})
      .map((res: Response) => res.json());
  }
}
