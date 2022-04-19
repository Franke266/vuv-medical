import { React, useState, useEffect } from 'react'
//import Login from '../login/login'
import useForm from './useOdgovoriForm'
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

export default function PorukeOdgovori(props) {
    const { id } = useParams()
    const [successMessage, setSuccessMessage] = useState('')
    const [poruke, setPoruke] = useState([])
    const [update, setUpdate] = useState(1)
  
  
    function Success(message) {
      setSuccessMessage(message)
      document.getElementById('submitButton').disabled = true
      setTimeout(() => {
        document.getElementById('redirect').click()
      }, 2000)
    }
  
    const myHeaders = new Headers()
    myHeaders.append('Content-Type', 'application/json')
  
  
    useEffect(() => {
      fetch(
        'http://localhost/vuv-medical/API/api/poruke/read.php',
        {
          method: 'GET',
          headers: myHeaders,
        }
      )
        .then((response) => response.json())
        .then((data) => setPoruke(data))
  
      fetch(
          'http://localhost/vuv-medical/API/api/poruke/readSingle.php?id=' +
          id,
        {
          method: 'GET',
          headers: myHeaders,
        }
      )
        .then((response) => response.json())
        .then((data) => {
          handleExistingValues(data)
        })
    }, [])
  
    const { handleChange, values, handleSubmit} = useForm(
      id,
      Success

    )
  
    const handleExistingValues = (data) => {
      values.doktor = data.doktor
      values.pacijent = data.pacijent
      setUpdate(update + 1)
    }
  
    return (
      <>
          <Grid item xs>
            <Paper className='editContainer' elevation={10}>
              <form onSubmit={handleSubmit}>
                <Grid className='gridClass' container spacing={3}>
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
  