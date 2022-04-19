import { React, useState, useEffect } from 'react'
//import Login from '../login/login'
import useForm from './useNovaPorukaForm'
//import validate from './validatePreglediEdit'
//import './pregledi.css'
import { Link, useParams } from 'react-router-dom'
import {
  Paper,
  Grid,
  TextField,
  FormHelperText,
  Button,
  FormControl,
  Select,
  InputLabel,
  MenuItem,
  Checkbox,
  FormGroup,
  FormControlLabel,
} from '@material-ui/core'

const url = 'http://localhost/vuv-medical/API/api/pacijenti/read.php'
  const myHeaders = new Headers()
  myHeaders.append('Content-Type', 'application/json')
  const requestOptions = {
    method: 'GET',
    heders: myHeaders,
  }


export default function PorukeNovaPoruka(props) {
    const { id } = useParams()
    const [successMessage, setSuccessMessage] = useState('')
    const [update, setUpdate] = useState(1)
    const [selectedOption, setSelectedOption] = useState('');

    const [pacijenti, setPacijenti] = useState([])
    const getPacijenti = async () => {
    const res = await fetch(url)
    const pacijenti = await res.json()
    setPacijenti(pacijenti)
    console.log(pacijenti)
  }
  
  
    function Success(message) {
      setSuccessMessage(message)
      document.getElementById('submitButton').disabled = true
      setTimeout(() => {
        document.getElementById('redirect').click()
      }, 2000)
    }
  
    

  useEffect(() => {
    getPacijenti()
  }, [])
  

    const { handleChange, values, handleSubmit} = useForm(
      Success,
      props
    )
  
  
    return (
      <>
          <Grid item xs>
            <Paper className='editContainer' elevation={10}>
              <form onSubmit={handleSubmit}>
                <Grid className='gridClass' container spacing={3}>
                <Grid item xs>
                      <>
                      <label>
                Odaberite doktora:
                <div className="select-container">
                <select class="selectPacijent"
                name="selectedOption"
                    onChange={handleChange}>
                        {pacijenti.map((item) => <option key={item.id} value={item.oib}>{item.imep} {item.prezimep}</option>
                    )}
                    </select>
                </div>
                </label>
                      </>
                  </Grid>
                  <Grid item xs>
                  <TextField
                    id='tekstInput'
                    type='text'
                    name='tekst'
                    variant='outlined'
                    label='Poruka'
                    className='input'
                    onChange={handleChange}
                  />
                </Grid>
                  <Link id='redirect' to='/poruke' />
                  <Button
                    id='submitButton'
                    type='submit'
                    variant='contained'
                    color='primary'
                    className='input'
                  >
                    Posalji
                  </Button>
                  {successMessage && (
                    <FormHelperText className='successText'>
                      {successMessage}
                    </FormHelperText>
                  )}
                </Grid>
              </form>
            </Paper>
          </Grid>
      
      </>
    )
  }
  