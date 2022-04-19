import React, { useState, useEffect } from 'react'
import { makeStyles } from '@material-ui/core/styles'
import Table from '@material-ui/core/Table'
import TableBody from '@material-ui/core/TableBody'
import TableCell from '@material-ui/core/TableCell'
import TableContainer from '@material-ui/core/TableContainer'
import TableHead from '@material-ui/core/TableHead'
import TableRow from '@material-ui/core/TableRow'
import Paper from '@material-ui/core/Paper'



const useStyles = makeStyles({
    table: {
      minWidth: 650,
      maxWidth: 1000,
      marginTop: 60,
      marginLeft: 'auto',
      marginRight: 'auto',
    },
  })
  const url_pacijenti =
    'http://localhost/vuv-medical/API/api/pacijenti/read.php'
  const Pacijenti = (props) => {
    const [pacijenti, setPacijenti] = useState([])
    const getPacijenti = async () => {
      const res = await fetch(url_pacijenti)
      const pacijenti = await res.json()
      setPacijenti(pacijenti)
      console.log(pacijenti)
    }
  
    useEffect(() => {
      getPacijenti()
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
                </TableRow>
              </TableHead>
              <TableBody>
                {pacijenti.map((row, index) => (
                  <TableRow key={row.id}>
                    {props.user.oib === row.doktor ? (
                      <>
                    <TableCell component='th' scope='row'>
                      {index+1}
                    </TableCell>
                    
                    <TableCell align='right'>{row.imep}</TableCell>
                    <TableCell align='right'>{row.prezimep}</TableCell>
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
    

export default Pacijenti;