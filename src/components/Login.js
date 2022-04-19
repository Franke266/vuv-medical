import {useState,useContext} from 'react';
import { Link } from 'react-router-dom';
import {UserContext} from '../UserContext';

const Login = () => {
    const {loginUser, wait, loggedInCheck} = useContext(UserContext);
    const [redirect, setRedirect] = useState(false);
    const [errMsg, setErrMsg] = useState(false);
    const [formData, setFormData] = useState({
        email:'',
        lozinka:''
    });

    const onChangeInput = (e) => {
        setFormData({
            ...formData,
            [e.target.name]:e.target.value
        })
    }

    const submitForm = async (e) => {
        e.preventDefault();

        if(!Object.values(formData).every(val => val.trim() !== '')){
            setErrMsg('Molimo popunite sva polja!');
            return;
        }

        const data = await loginUser(formData);
        if(data.success){
            e.target.reset();
            setRedirect('Učitavanje...');
            await loggedInCheck();
            return;
        }
        setErrMsg(data.message);
    }

    return (
        <div className="myform">
            <h2>Prijava</h2>
            <form onSubmit={submitForm}>
                <label htmlFor="email">Email:</label>
                <input type="email" name="email" onChange={onChangeInput} placeholder="ime.prezime@gmail.com" id="email" value={formData.email} required />
                <label htmlFor="password">Lozinka:</label>
                <input type="password" name="lozinka" onChange={onChangeInput} placeholder="Unesite lozinku" id="lozinka" value={formData.lozinka} required />
                {errMsg && <div className="err-msg">{errMsg}</div>}
                {redirect ? redirect : <button type="submit" disabled={wait}>Prijava</button>}
                <div className="bottom-link"><Link to="/signup">Registracija</Link></div>
            </form>
        </div>
    )
}

export default Login;