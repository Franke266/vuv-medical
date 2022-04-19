import {useContext, useState} from 'react'
import {Link} from 'react-router-dom'
import {UserContext} from '../UserContext';
import React, { Component, useEffect } from 'react'


  const url = 'http://localhost/vuv-medical/API/api/doktori/read.php'
  const myHeaders = new Headers()
  myHeaders.append('Content-Type', 'application/json')
  const requestOptions = {
    method: 'GET',
    heders: myHeaders,
  }



const Register = () => {
    const {registerUser, wait} = useContext(UserContext);
    const [errMsg, setErrMsg] = useState(false);
    const [successMsg, setSuccessMsg] = useState(false);
    const [selectedOption, setSelectedOption] = useState(11111111111);
    const [formData, setFormData] = useState({
        ime:'',
        prezime:'',
        oib:'',
        email:'',
        lozinka:'',
        selectedOption
    });

    const onChangeInput = (e) => {
        setFormData({
            ...formData,
            [e.target.name]:e.target.value
        })
    }


    const submitForm = async (e) => {
        e.preventDefault();

        //if(formData.ime.trim() === '' || formData.prezime.trim() === '' || formData.email.trim() === '' || formData.lozinka.trim() === ''){
            //setSuccessMsg(false);
            //setErrMsg('Molimo popunite sva polja!');
            //return;
        //}

        //if(!Object.values(formData).every(val => val.trim() !== '')){
            //setSuccessMsg(false);
            //setErrMsg('Molimo popunite sva polja!');
            //return;
        //}

        const data = await registerUser(formData);
        if(data.success){
            e.target.reset();
            setSuccessMsg('Uspješno ste registrirani!');
            setErrMsg(false);
        }
        else if(!data.success && data.message){
            setSuccessMsg(false);
            setErrMsg(data.message);
        }
        
    }

    const [doktori, setDoktori] = useState([])
  const getDoktori = async () => {
    const res = await fetch(url)
    const doktori = await res.json()
    setDoktori(doktori)
    console.log(doktori)
  }

  useEffect(() => {
    getDoktori()
  }, [])
  

    return (
        <div className="myform">
            <h2>Registracija</h2>
            <form onSubmit={submitForm}>
                <label htmlFor="name">Ime:</label>
                <input type="text" name="ime" onChange={onChangeInput} placeholder="Unesite ime" id="ime" value={formData.ime} required />
                <label htmlFor="prezime">Prezime:</label>
                <input type="text" name="prezime" onChange={onChangeInput} placeholder="Unesite prezime" id="prezime" value={formData.prezime} required />
                <label htmlFor="oib">Oib:</label>
                <input type="text" name="oib" onChange={onChangeInput} placeholder="Unesite oib" id="oib" value={formData.oib} required />
                <label htmlFor="email">Email:</label>
                <input type="email" name="email" onChange={onChangeInput} placeholder="ime.prezime@gmail.com" id="email" value={formData.email} required />
                <label htmlFor="password">Lozinka:</label>
                <input type="password" name="lozinka" onChange={onChangeInput} placeholder="Unesite lozinku" id="lozinka" value={formData.lozinka} required />
                <label>
                Odaberite doktora:
                <div className="select-container">
                <select class="selectDoktor"
                name="selectedOption"
                    onChange={onChangeInput}>
                        {doktori.map((item) => <option key={item.id} value={item.oib}>{item.ime} {item.prezime}</option>
                    )}
                    </select>
                </div>
                </label>
                {successMsg && <div className="success-msg">{successMsg}</div>}
                {errMsg && <div className="err-msg">{errMsg}</div>}
                <button type="submit" disabled={wait}>Registracija</button>
                <div className="bottom-link"><Link to="/login">Prijava</Link></div>
            </form>
        </div>
    )
}

export default Register;