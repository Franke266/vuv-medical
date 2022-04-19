import { React, useState, useEffect } from 'react'
//import Login from '../login/login'
import useForm from './useNovaPorukaPForm'
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


export default function PorukeNovaPoruka(props) {
    const { id } = useParams()
    const [successMessage, setSuccessMessage] = useState('')
    const [update, setUpdate] = useState(1)

  
  
    function Success(message) {
      setSuccessMessage(message)
      document.getElementById('submitButton').disabled = true
      setTimeout(() => {
        document.getElementById('redirect').click()
      }, 2000)
    }
  

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
                  <Link id='redirect' to='/porukeP' />
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
  