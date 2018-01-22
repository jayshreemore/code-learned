import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from "rxjs";

@Injectable()
export class UserService {
  isLoginSubject = new BehaviorSubject<any>(this.hasToken());

  /**
   *
   * @returns {Observable<T>}
   */
  isLoggedIn() : Observable<any> {
    return this.isLoginSubject.asObservable();
  }

  /**
   *  Login the user then tell all the subscribers about the new status
   */
  login() : void {
    this.isLoginSubject.next(true);
    console.log('from user serviece test:')
    console.log(this.isLoginSubject);
  }

  /**
   * Log out the user then tell all the subscribers about the new status
   */
  logout() : void {
    this.isLoginSubject.next(false);
  }

  /**
   * if we have token the user is loggedIn
   * @returns {boolean}
   */
  private hasToken() : any {
    return false;
  }
}
