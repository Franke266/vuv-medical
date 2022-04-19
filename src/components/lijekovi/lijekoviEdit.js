import { React, useState, useEffect } from 'react'
//import Login from '../login/login'
import useForm from './useEditForm'
import validate from './validateLijekoviEdit'
import './lijekovi.css'
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

export default function LijekoviEdit(props) {
  const { id } = useParams()
  const [successMessage, setSuccessMessage] = useState('')
  const [lijekovi, setLijekovi] = useState([])
  const [update, setUpdate] = useState(1)
  const [disableSelect, setDisableSelect] = useState(false)


  function Success(message) {
    setSuccessMessage(message)
    document.getElementById('submitButton').disabled = true
    setTimeout(() => {
      document.getElementById('redirect').click()
    }, 2000)
  }

  const myHeaders = new Headers()
  myHeaders.append('Content-Type', 'application/json')

  const statusi = [
    { value: 1, label: 'Na čekanju' },
    { value: 2, label: 'U ljekarnoj' },
    { value: 3, label: 'Odbijeno' }
  ]

  useEffect(() => {
    fetch(
      'http://localhost/vuv-medical/API/api/lijekovi/read.php',
      {
        method: 'GET',
        headers: myHeaders,
      }
    )
      .then((response) => response.json())
      .then((data) => setLijekovi(data))

    fetch(
        'http://localhost/vuv-medical/API/api/lijekovi/readSingle.php?id=' +
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
    //validate,
    id,
    Success
  )

  const handleExistingValues = (data) => {
    values.oib = data.oib
    values.ime = data.ime
    values.prezime = data.prezime
    values.vrsta = data.vrsta
    values.status = data.status
    values.doktor = data.doktor
    setUpdate(update + 1)
  }

  return (
    <>
        <Grid item xs>
          <Paper className='editContainer' elevation={10}>
            <form onSubmit={handleSubmit}>
              <Grid className='gridClass' container spacing={3}>
                <Grid item xs>
                    <>
                      <FormControl variant='outlined' className='selectEdit'>
                        <InputLabel id='labelStatusi'>Status</InputLabel>
                        <Select
                          labelId='labelStatusi'
                          name='status'
                          value={values.status}
                          onChange={handleChange}
                          label='Status'
                        >
                          {statusi.map((status) => (
                            <MenuItem key={status.value} value={status.label}>
                              {status.label}
                            </MenuItem>
                          ))}
                        </Select>
                      </FormControl>
                    </>
                </Grid>
                <Link id='redirect' to='/lijekovi' />
                <Button
                  id='submitButton'
                  type='submit'
                  variant='contained'
                  color='primary'
                  className='input'
                >
                  Ažuriraj
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
