from socket import *
import sys, time

if len(sys.argv) <= 1:
    print 'Usage: "python proxy.py server_ip"\n[server_ip : It is the IP Address of the Proxy Server'
    sys.exit(2)

# Create a server socket, bind it to a port and start listening
tcpSERVERPort = 8080
tcpSERVERSock = socket(AF_INET, SOCK_STREAM)
fp = open('log.txt','w')
# Prepare a server socket
tcpSERVERSock.bind((sys.argv[1], tcpSERVERPort))
tcpSERVERSock.listen(5)

while True:
    # Start receiving data from the client
    print 'Ready to serve...'
    tcpCLIENTSock, addr = tcpSERVERSock.accept()
    print 'Received a connection from: ', addr
    t = time.time()
    message = tcpCLIENTSock.recv(4096)
    print "message= Hello ",message
    fp.write(message)
    a = len(message)
    print 'number of bytes sent =',a
    # Extract the filename from the given message
    if message == '':
        print "No data"
    else:
        print "m2=::::",message.split()[1]
        filename = message.split()[1].partition("/")[2]
        print "filename = ",filename
        fileExist = "false"
        filetouse = "/" + filename
        print "filetouse= :",filetouse
    try:
        # Check whether the file exists in the cache
        f = open(filetouse[1:], "r")
        outputdata = f.readlines()
	b = len(outputdata)
	print "bytes received from server = ",b
        print "outputdata = ",outputdata
        fileExist = "true"
        print 'File Exists!'

        # ProxyServer finds a cache hit and generates a response message
        tcpCLIENTSock.send("HTTP/1.0 200 OK\r\n")
        print "HTTP/1.0 200 OK\r\n"
        tcpCLIENTSock.send("Content-Type:text/html\r\n")

        # Send the content of the requested file to the client
        for i in range(0, len(outputdata)):
            tcpCLIENTSock.send(outputdata[i])
        print 'Read from cache'

        # Error handling for file not found in cache
    except IOError:
        print 'File Exist: ', fileExist
        if fileExist == "false":
            # Create a socket on the proxyserver
            print 'Creating socket on proxyserver'
            c = socket(AF_INET, SOCK_STREAM)

            hostn = filename.replace("www.", "", 1)
            print 'Host Name: ', hostn
            try:
                # Connect to the socket to port 80
                c.connect((hostn, 80))
                print 'Socket connected to port 80 of the host'

                # Create a temporary file on this socket and ask port 80
                # for the file requested by the client
                fileobj = c.makefile('r', 0)
                fileobj.write("GET " + "http://" + filename + " HTTP/1.0\n\n")

                # Read the response into buffer
                buffer = fileobj.readlines()
		b = len(buffer)
		print 'bytes received =' ,b
		#resp = c.recv(4096)
		#response = ""
		#while resp:
			#response += resp
                # Create a new file in the cache for the requested file.
                # Also send the response in the buffer to client socket
                # and the corresponding file in the cache
                tempFile = open("./" + filename, "wb")
		#tempFile.write(response)
                #tempFile.close()
                #tcpcLIENTsock.send(response)
                for i in range(0, len(buffer)):
                    tempFile.write(buffer[i])
                    tcpCLIENTSock.send(buffer[i])

            except:
                print 'illegal request'

        else:
            # HTTP response message for file not found
            print 'File Not Found...'
	elap = time.time()
	diff = elap - t
    # Close the socket and the server sockets
    tcpCLIENTSock.close()
    fp.write("\n time taken =" + str(diff))
    fp.write("\n bytes sent =" + str(a))
    fp.write("\n bytes received =" + str(b))
    fp.write("\n")
fp.close()
print "Closing the server connection"
tcpSERVERSock.close()
