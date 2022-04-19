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
import EditIcon from '@mui/icons-material/Edit';


const useStyles = makeStyles({
    table: {
      minWidth: 650,
      maxWidth: 1000,
      marginTop: 60,
      marginLeft: 'auto',
      marginRight: 'auto',
    },
  })
  const url_lijekovi =
    'http://localhost/vuv-medical/API/api/lijekovi/read.php'
  const Lijekovi = (props) => {
    const [lijekovi, setLijekovi] = useState([])
    const getLijekovi = async () => {
      const res = await fetch(url_lijekovi)
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
          <TableContainer className={classes.table} component={Paper}>
            <Table aria-label='simple table'>
              <TableHead>
                <TableRow>
                  <TableCell>Rbr.</TableCell>
                  <TableCell align='right'>Ime</TableCell>
                  <TableCell align='right'>Prezime</TableCell>
                  <TableCell align='right'>Vrsta</TableCell>
                  <TableCell align='right'>Status</TableCell>
                  <TableCell align='right'>Ažuriraj</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {lijekovi.map((row, index) => (
                  <TableRow key={row.id}>
                    {props.user.oib === row.doktor ? (
                      <>
                    <TableCell component='th' scope='row'>
                      {index+1}
                    </TableCell>
                    <TableCell align='right'>{row.imep}</TableCell>
                    <TableCell align='right'>{row.prezimep}</TableCell>
                    <TableCell align='right'>{row.vrsta}</TableCell>
                    <TableCell align='right'>{row.status}</TableCell>
                    <TableCell>
                      <Link to={'/lijekovi/azuriraj/id/' + row.id}>
                        <IconButton collor='primary'>
                          <EditIcon />
                        </IconButton>
                      </Link>
                    </TableCell>
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