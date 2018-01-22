import { BrowserModule } from '@angular/platform-browser';
import { CommonModule } from '@angular/common'; 
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { FormsModule } from '@angular/forms';
import { AppComponent } from './app.component';
import { ContactsComponent } from './contacts/contacts.component';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import {UserService} from './user.Service';
import {AuthGuard} from './auth.guard';
import { RegistrationComponent } from './registration/registration.component';
import { CustomFormsModule } from 'ng2-validation';
import {OnlyloggedinuserGuard} from './onlyloggedinuser.guard';
import { ProductsComponent } from './products/products.component';
import { CatfilterPipe } from './catfilter.pipe';
import {CurrentuserinfoService} from './currentuserinfo.service';
import { ShowcartComponent } from './showcart/showcart.component';
import { MaincomponentComponent } from './maincomponent/maincomponent.component';


const appRoutes:Routes = [
  {
    path: '',
    component:LoginComponent
  },
  {
    path:'home',
   // canActivate:[OnlyloggedinuserGuard,AuthGuard],
    component:ContactsComponent
  },
  {
    path:"registration",
    component:RegistrationComponent
  },
  {
    path:"productslist",
    //canActivate:[OnlyloggedinuserGuard,AuthGuard],
    component:ProductsComponent
  },
  {
    path:"mycart",
    //canActivate:[OnlyloggedinuserGuard,AuthGuard],
    component:ShowcartComponent
  },
  {
    path:"main",
    //canActivate:[OnlyloggedinuserGuard,AuthGuard],
    component:MaincomponentComponent
  },
  {
    path:'main/home',
    //canActivate:[OnlyloggedinuserGuard,AuthGuard],
    component:ContactsComponent
  },
  {
    path:"main/registration",
    component:RegistrationComponent
  },
  {
    path:"main/productslist",
    //canActivate:[OnlyloggedinuserGuard,AuthGuard],
    component:ProductsComponent
  },
  {
    path:"main/mycart",
    //canActivate:[OnlyloggedinuserGuard,AuthGuard],
    component:ShowcartComponent
  }
]



@NgModule({
  declarations: [
    CatfilterPipe,
    AppComponent,
    ContactsComponent,
    LoginComponent,
    HeaderComponent,
    FooterComponent,
    RegistrationComponent,
    ProductsComponent,
    ShowcartComponent,
    MaincomponentComponent,
    
  ],
  imports: [
    CommonModule,
    BrowserModule,
    HttpModule,
    FormsModule,
    CustomFormsModule,
    RouterModule.forRoot(appRoutes),
    
  ],
  providers: [UserService,AuthGuard,OnlyloggedinuserGuard,CurrentuserinfoService],
  bootstrap: [AppComponent]
})
export class AppModule { }
