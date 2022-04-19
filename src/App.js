import './App.css';
import {useContext} from 'react'
import { BrowserRouter, Routes, Route, Navigate} from 'react-router-dom';
import {UserContext} from './UserContext';
import Sidebar from './Navbar/sidebar'
import Login from './components/Login';
import Register from './components/Register';
import Home from './components/Home';
import Pacijent from './components/pacijenti/Pacijenti';
import Pregled from './components/pregledi/Pregledi';
import PregledP from './components/pregledi/PreglediP';
import PreglediEdit from './components/pregledi/preglediEdit';
import PreglediAdd from './components/pregledi/preglediAdd';
import Uputnica from './components/uputnice/Uputnice';
import UputnicaP from './components/uputnice/UputniceP';
import UputniceEdit from './components/uputnice/uputniceEdit';
import UputniceAdd from './components/uputnice/uputniceAdd';
import Lijek from './components/lijekovi/Lijekovi';
import LijekP from './components/lijekovi/LijekoviP';
import LijekoviEdit from './components/lijekovi/lijekoviEdit';
import LijekoviAdd from './components/lijekovi/lijekoviAdd';
import Poruka from './components/poruke/Poruke';
import PorukaNova from './components/poruke/PorukeNovaPoruka';
import PorukaOdgovori from './components/poruke/PorukeOdgovori';
import PorukaP from './components/poruke/PorukeP';
import PorukaNovaP from './components/poruke/PorukeNovaPorukaP';
import PorukaOdgovoriP from './components/poruke/PorukeOdgovoriP';

function App() {
  
  const {user} = useContext(UserContext);
  const {logout} = useContext(UserContext);

  

  return (
    <div className="container">
        <BrowserRouter>
        { user && <Sidebar user={user} logOut={logout} />}
          <Routes>
            { user && <Route path="/" element={<Pacijent user={user}/>} /> }
            {!user && (
              
              <>
              <Route path="/login" element={<Login/>} />
              <Route path="/signup" element={<Register/>} />
              </>
            )}
            <Route path="*" element={<Navigate to={user ? '/':'/login'} />} />
            <Route path="/pregledi" element={<Pregled  user={user}/>} />
            <Route path='/pregledi/azuriraj/id/:id' element={<PreglediEdit  user={user}/>}/>
            <Route path="/uputnice" element={<Uputnica  user={user}/>} />
            <Route path='/uputnice/azuriraj/id/:id' element={<UputniceEdit  user={user}/>}/>
            <Route path="/lijekovi" element={<Lijek  user={user}/>} />
            <Route path='/lijekovi/azuriraj/id/:id' element={<LijekoviEdit  user={user}/>}/>
            <Route path="/poruke" element={<Poruka  user={user}/>} />
            <Route path="/poruke/dodaj" element={<PorukaNova  user={user}/>} />
            <Route path='/poruke/odgovori/id/:id' element={<PorukaOdgovori  user={user}/>}/>
            <Route path="/pregledip" element={<PregledP  user={user}/>} />
            <Route path='/pregledip/dodaj' element={<PreglediAdd  user={user}/>}/>
            <Route path="/uputnicep" element={<UputnicaP  user={user}/>} />
            <Route path='/uputnicep/dodaj' element={<UputniceAdd  user={user}/>}/>
            <Route path="/lijekovip" element={<LijekP  user={user}/>} />
            <Route path='/lijekovip/dodaj' element={<LijekoviAdd  user={user}/>}/>
            <Route path="/porukep" element={<PorukaP  user={user}/>} />
            <Route path="/porukep/dodaj" element={<PorukaNovaP  user={user}/>} />
            <Route path='/porukep/odgovori/id/:id' element={<PorukaOdgovoriP  user={user}/>}/>
           
            
          </Routes>
        </BrowserRouter>
    </div>
  )
}

export default App;
            