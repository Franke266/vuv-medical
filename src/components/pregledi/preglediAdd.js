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

    const razlozi = [
      { value: 1, label: 'Pregled' },
      { value: 2, label: 'Uputnica' }
    ]
  

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
                      <FormControl variant='outlined' className='selectEdit'>
                          <InputLabel id='labelRazlozi'>Razlog</InputLabel>
                          <Select
                            labelId='labelRazlozi'
                            name='razlog'
                            value={values.razlog}
                            onChange={handleChange}
                            label='Razlog'
                          >
                            {razlozi.map((razlog) => (
                              <MenuItem key={razlog.value} value={razlog.label}>
                                {razlog.label}
                              </MenuItem>
                            ))}
                          </Select>
                        </FormControl>
                      </>
                  </Grid>
                  <Grid item xs>
                  <TextField
                    id='opisInput'
                    type='text'
                    name='opis'
                    variant='outlined'
                    label='Opis problema'
                    className='input'
                    onChange={handleChange}
                  />
                </Grid>
                  <Link id='redirect' to='/preglediP' />
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