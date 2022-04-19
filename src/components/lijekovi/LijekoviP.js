import React, { useState, useEffect } from 'react'
import PropTypes from 'prop-types'
import { makeStyles, useTheme } from '@material-ui/core/styles'
import IconButton from '@material-ui/core/IconButton'
import Table from '@material-ui/core/Table'
import TableBody from '@material-ui/core/TableBody'
import TableCell from '@material-ui/core/TableCell'
import TableContainer from '@material-ui/core/TableContainer'
import { TableFooter, TablePagination } from '@material-ui/core'
import TableHead from '@material-ui/core/TableHead'
import TableRow from '@material-ui/core/TableRow'
import Paper from '@material-ui/core/Paper'
import { Link } from 'react-router-dom'
//import Login from '../login/login'
import { Container } from '@material-ui/core'
//import '../login/auth.css'
import Button from '@material-ui/core/Button'


const useStyles = makeStyles({
    table: {
      minWidth: 650,
      maxWidth: 1000,
      marginTop: 60,
      marginLeft: 'auto',
      marginRight: 'auto',
    },
  })
  const url =
    'http://localhost/vuv-medical/API/api/lijekovi/read.php'
  const Lijekovi = (props) => {
    const [lijekovi, setLijekovi] = useState([])
    const getLijekovi = async () => {
      const res = await fetch(url)
      const lijekovi = await res.json()
      setLijekovi(lijekovi)
      console.log(lijekovi)
    }
  
    useEffect(() => {
      getLijekovi()
    }, [])
  
    const classes = useStyles()

    return (
        <>
        <Link to={'/lijekoviP/dodaj'}>
        <Button
                    id='submitButton'
                    type='submit'
                    variant='contained'
                    color='primary'
                    className='input'
                  >
                    Naruči lijekove
        </Button>
        </Link>
          <TableContainer className={classes.table} component={Paper}>
            <Table aria-label='simple table'>
              <TableHead>
                <TableRow>
                  <TableCell>Rbr.</TableCell>
                  <TableCell align='right'>Vrsta</TableCell>
                  <TableCell align='right'>Status</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {lijekovi.map((row, index) => (
                  <TableRow key={row.id}>
                    {props.user.oib === row.oib ? (
                      <>
                    <TableCell component='th' scope='row'>
                      {index+1}
                    </TableCell>
                    <TableCell align='right'>{row.vrsta}</TableCell>
                    <TableCell align='right'>{row.status}</TableCell>
                    </>
                    ) :(
                      ''
                      )}
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </TableContainer>
        </>
      )
    }
    

export default Lijekovi;