from flask import Flask, redirect, render_template, request, url_for
from flaskext.mysql import MySQL

app=Flask(__name__)

mysql=MySQL()
app.config["MYSQL_DATABASE_USER"]='root'
app.config["MYSQL_DATABASE_PASSWORD"]=''
app.config["MYSQL_DATABASE_DB"]='bbdd'
#app.config["MYSQL_DATABASE_HOST"]='localhost'
mysql.init_app(app)

@app.route("/login", methods=['GET', 'POST'])
def login():
    if request.method=='POST':
        usuario=request.form['usuario']
        contrasena=request.form['contrasena']
        con=mysql.connect()
        cur=con.cursor()
        cur.execute("SELECT * FROM 'registro' WHERE 'usuario' = "+usuario+"' and 'contrasena' = '"+contrasena+"'")
        data=cur.fetchone()
        if data[2]==usuario and data[3]==contrasena:
            return redirect(url_for('home', data=data[0]))
    else:
        error="invalid"
        return render_template("login.html")

@app.route("/registro", methods=['GET', 'POST'])
def registro():
    if request.method=='POST':
        correo=request.form['correo']
        usuario=request.form['usuario']
        contrasena=request.form['contrasena']
        con=mysql.connect()
        cur=con.cursor()
        cur.execute("INSERT INTO 'registro' ('correo', 'usuario', 'contrasena') VALUES (%s, %s, %s)", (correo, usuario, contrasena))
        con.commit()
        return redirect('login')
    else:
        return render_template("registro.html")

if(__name__=='__main__'):
    app.run(debug=True)
