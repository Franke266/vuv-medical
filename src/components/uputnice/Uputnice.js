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
  const url =
    'http://localhost/vuv-medical/API/api/uputnice/read.php'
  const Uputnice = (props) => {
    const [uputnice, setUputnice] = useState([])
    const getUputnice = async () => {
      const res = await fetch(url)
      const uputnice = await res.json()
      setUputnice(uputnice)
      console.log(uputnice)
    }
  
    useEffect(() => {
      getUputnice()
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
                  <TableCell align='right'>Opis</TableCell>
                  <TableCell align='right'>Status</TableCell>
                  <TableCell align='right'>Ažuriraj</TableCell>
                </TableRow>
              </TableHead>
              <TableBody>
                {uputnice.map((row, index) => (
                  <TableRow key={row.id}>
                    {props.user.oib === row.doktor ? (
                      <>
                    <TableCell component='th' scope='row'>
                      {index+1}
                    </TableCell>
                    <TableCell align='right'>{row.imep}</TableCell>
                    <TableCell align='right'>{row.prezimep}</TableCell>
                    <TableCell align='right'>{row.opis}</TableCell>
                    <TableCell align='right'>{row.status}</TableCell>
                    <TableCell>
                      <Link to={'/uputnice/azuriraj/id/' + row.id}>
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
    

export default Uputnice;