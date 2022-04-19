import { React, useState, useEffect } from 'react'
//import Login from '../login/login'
import useForm from './useAddForm'
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

export default function PreglediAdd(props) {
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
  
    const myHeaders = new Headers()
    myHeaders.append('Content-Type', 'application/json')

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
                    id='vrstaInput'
                    type='text'
                    name='vrsta'
                    variant='outlined'
                    label='Vrsta'
                    className='input'
                    onChange={handleChange}
                  />
                </Grid>
                  <Link id='redirect' to='/lijekoviP' />
                  <Button
                    id='submitButton'
                    type='submit'
                    variant='contained'
                    color='primary'
                    className='input'
                  >
                    Potvrdi
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
  