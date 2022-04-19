import {useContext} from 'react'
import {UserContext} from '../UserContext'
import Sidebar from '../Navbar/sidebar'

const Home = () => {
    const {user, logout} = useContext(UserContext);
    return (
        <div className="home">
            <div className="img">🧒🏻</div>
            <h1>{user.ime}<br/><span>{user.email}</span></h1>
            <button onClick={logout} className="logout">Odjava</button>
        </div>
    )
}

export default Home;